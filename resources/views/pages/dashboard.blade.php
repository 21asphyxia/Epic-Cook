@extends('layouts.app')
@section('content')
<div class="mt-2 d-flex justify-content-evenly w-100 mb-5 flex-wrap">
    <div class="ps-3 pe-5 py-3 box mb-4">
        <div class="fs-5 mb-4 fw-bold">Total Articles</div>
        <div class="fs-6"><?= $totalArticles ?> Articles</div>
    </div>
    <div class="ps-3 pe-5 py-3 box mb-4">
        <div class="fs-5 mb-4 fw-bold">Total Categories</div>
        <div class="fs-6"><?= $totalCategories ?> Categories</div>
    </div>
</div>
<div class="box max-vh-50">
    <span class="fw-bold ps-3">Developers Stats</span>
    <div class="table-responsive mt-3">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th class="text-secondary fs-7 text-center col-2 align-middle" scope="col">#</th>
                    <th class="text-secondary fs-7 text-center col-5 align-middle" scope="col">Developer Name</th>
                    <th class="text-secondary fs-7 text-center col-5 align-middle" scope="col">No. of Articles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($allDevs as $key => $dev) {
                    echo '<tr>
                    <th class="text-center align-middle" scope="row">'.$dev['id'].'</th>
                    <td class="text-center align-middle">'.$dev['username'].'</td>
                    <td class="text-center align-middle">'.$dev['total'].'</td>
                    </tr>';
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>