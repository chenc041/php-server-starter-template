<?php

namespace app\controller;
use support\Redis;
use Support\Response;
use app\model\Test;

class IndexController
{
    public function index()
    {
        static $readme;
        if (!$readme) {
            $readme = file_get_contents(base_path('README.md'));
        }
        return $readme;
    }

    public function view(): Response
    {
        return view('index/view', ['name' => 'web-man']);
    }

    public function json(): Response
    {
        $tags = Test::all();
        return json(['code' => 0, 'msg' => 'ok', 'data' => $tags]);
    }

    public function redis(): Response {
        Redis::set('key', 'hello world');

        $value = Redis::get('key');
        return json([
            'code' => 0,
            'msg' => 'ok',
            'data' => $value
        ]);
    }

}
