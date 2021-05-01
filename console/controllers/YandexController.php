<?php

namespace console\controllers;

use Arhitector\Yandex\Disk;
use common\models\GalleryFile;
use common\models\GalleryFolder;
use yii\httpclient\Client;
use yii\console\Controller;

class YandexController extends Controller
{
    private $yandex_token = 'AQAAAAAir43hAAcVuNLQ56U6o0RQqS2oTdawyCQ';
    private $yandex_dir = 'https://cloud-api.yandex.net/v1/disk/public/resources';
    private $public_key = 'https://disk.yandex.ru/d/fl9HjZNmB6tlgg';

    public function actionIndex()
    {
        GalleryFolder::deleteAll();
        array_map('unlink', glob('backend/web/storage/gallery/*.*'));
        $this->getFromDir('/');
    }

    public function get($path){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($this->yandex_dir)
            ->setData([
                'public_key' => $this->public_key,
                'limit' => 100,
                'path'=>$path
            ])
            ->setHeaders([
                'Authorization' => "OAuth {$this->yandex_token}"
            ])
            ->send();
        return $response->getData();

    }

    public function getFromDir($path,$parent_folder_id=null){
        echo $path.PHP_EOL;
        $data = $this->get($path);
        if(isset($data) && isset($data['_embedded']) && isset($data['_embedded']['items'])) {
            $folder = new GalleryFolder([
                'name'=>$data['name'],
                'original_path'=>$path,
                'parent_id'=>$parent_folder_id
            ]);
            $folder->save();

            foreach ($data['_embedded']['items'] as $item){
                if($item['type'] === 'dir') {
                    $this->getFromDir($item['path'],$folder->id);
                } elseif($item['type'] === 'file' && $item['media_type'] === 'image') {
                    $this->downloadFile($item['file'],$item['preview'],$item['name'],$folder->id);
                }
            }
        }
    }


    public function downloadFile($path,$preview_path,$filename,$folder_id){
        $storage_path = '/storage/gallery/'.date('U').'_preview_'.$filename;
        $storage_preview_path = '/storage/gallery/'.date('U').'_'.$filename;
        if(
            file_put_contents( 'backend/web'.$storage_path,file_get_contents($path))
            && file_put_contents( 'backend/web'.$storage_preview_path,file_get_contents($preview_path))
        ) {
            $gallery_file = new GalleryFile([
                'name'=>$filename,
                'url'=>$storage_path,
                'preview_url'=>$storage_preview_path,
                'gallery_folder_id'=>$folder_id
            ]);
            $gallery_file->save();
            echo "File downloaded successfully \n";
        }
        else {
            echo "File downloading failed\n.";
        }

    }
}
