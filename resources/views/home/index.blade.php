@extends('layouts.body')
@section('content')
    <div class="row">
        <!-- 左侧列表开始 -->
        <div class="col-xs-12 col-md-12 col-lg-8">
            <!-- 循环文章列表开始 -->
            <div class="row b-one-article">
                <h3 class="col-xs-12 col-md-12 col-lg-12">
                    <a class="b-oa-title" href="{{ route('article') }}" target="_blank">这是一个霸气的测试</a>
                </h3>
            </div>
            <!-- 循环文章列表结束 -->

            <!-- 列表分页开始 -->
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 b-page text-center">
                    <ul class="pagination">

                        <li class="disabled"><span>上一页</span></li>





                        <li class="active"><span>1</span></li>
                        <li><a href="https://baijunyao.com/category/27?page=2">2</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=3">3</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=4">4</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=5">5</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=6">6</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=7">7</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=8">8</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=9">9</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=10">10</a></li>
                        <li><a href="https://baijunyao.com/category/27?page=11">11</a></li>


                        <li><a href="https://baijunyao.com/category/27?page=2" rel="next">下一页</a></li>
                    </ul>

                </div>
            </div>
            <!-- 列表分页结束 -->
        </div>
        <!-- 左侧列表结束 -->
        <!-- 通用右部区域开始 -->
        <div id="b-public-right" class="col-lg-4 hidden-xs hidden-sm hidden-md">
        </div>
        <!-- 通用右部区域结束 -->
    </div>
@stop

