<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
  'menu' => [
        // [
        //     'icon' => 'fa fa-home',
        //     'title' => 'Dashboard',
        //     'url' => '/',
        //     'route-name' => 'admin.index'
        // ],
        [
                'icon' => 'fa fa-folder',
                'title' => 'Data Siswa',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/',
                        'title' => 'Daftar Ulang',
                        'route-name' => 'admin.index',
                    ]]
            ],[
                'icon' => 'fa fa-folder',
                'title' => 'Master Data',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/master-kelas',
                        'title' => 'Kelas',
                        'route-name' => 'admin.kelas',
                    ],[
                        'url' => '/master-jurusan',
                        'title' => 'Jurusan',
                        'route-name' => 'admin.jurusan',
                    ],[
                        'url' => '/master-tahunajaran',
                        'title' => 'Tahun Ajaran',
                        'route-name' => 'admin.tahunajaran',
                    ]]
            ],[
            'icon' => 'fa fa-users',
            'title' => 'Kelola User',
            'url' => '/master-user',
            'route-name' => 'admin.masteruser'
        ]
    ]
];
