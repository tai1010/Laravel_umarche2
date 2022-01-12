<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    public function showServiceContainerTest(){
        app()->bind('lifeCycleTest', function(){ 
            return 'ライフサイクルテスト';
            });
       $test= app()->make('lifeCycleTest');

    //    //サービスコンテナなしの場合 
    //    $message=new Message();
    //    $sample=new Sample($message);
    //    $sample->run();
    //     dd($test,app());

    //サービスコンテナありの場合　インスタンス化しなくていい
    app()->bind('sample',Sample::class);
    $sample=app()->make('sample');
    $sample->run();

        dd($test,app());
    }
}

class Sample{
    public $message;
    public function __construct(Message $message){//クラスを渡す
        $this->message=$message;
        //dd($message);
        
    }
    public function run(){ //上記で渡すことでsendメソッドが使える
        $this->message->send();
    }
}
class Message{
    public function send(){
        echo('メッセージ');
    }
}