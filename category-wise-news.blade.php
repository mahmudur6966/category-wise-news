@extends("asian.layouts.AsianMaster")

@section("title","Asian Team")

@section("content")


    <div class="">
        <section class="distric--news--here">
        <div class="container">
            @if($category->id != 18 && $category->id !=20)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"> <i class="fa fa-home"></i> </a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('asian.category-news',$category->id) }}">{{ $category->name }}</a></li>
                    </ol>
                </nav>
            @endif

            @if($category->id == 18 )
                <div class="container p-0">
                    <div class="custom_jhelar_khobor_title">
                        <ul class="list-inline">
                            <li class=" one">জেলার খবর:</li>
                            @forelse(parent_sub_category(116) as $key=>$children)
                                <li class=" two">
                                    <select class="form-control view_category_news">
{{--                                        <option value selected> {{ $children->name }}  </option>--}}
                                        <option value="{{ $children->id }}">{{ $children->name }}</option>
                                        @forelse(parent_sub_category($children->id) as $key2=>$child)
                                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endif


            {{-- Bissho News Showing according to ID no of Bissho Category start --}}

            @if($category->id == 20)
                <div class="container p-0">
                    <div class="custom_jhelar_khobor_title">
                        <ul class="list-inline">
                            <li class=" one">উপমহাদেশের খবর : </li>
                            <li class=" two">
                                <select class="form-control view_category_news">
                                    @forelse(parent_sub_category(\App\Service\AsianService::BISSHO_NEWS_ID) as $key2=>$child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Bissho News Showing according to ID no of Bissho Category start --}}

            <div class="main--news--distric">
                <div class="row">
                    <div class="{{ $category->id ==18 ? 'col-md-9' : 'col-lg-12' }} col-sm-4 col-xs-12">
                        <div class="distric--category--news">
                            {{-- 1 Large & 4 mini start --}}
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                    @forelse($news as $key=>$info)
                                        @if($loop->first)
                                            <a style="color:#000;" href="{{ route('asian.single-news-read',$info->slug) }}">
                                                <div class="media--section--distric">
                                                    <div class="{{ $category->id ==18 ? 'division_news_big_image' : 'category_news_big_image' }} ">
                                                        @php
                                                            $path = $info->pictures->count()> 0 ? \App\Service\AsianService::POST_PICTURE : \App\Service\AsianService::POST_THUMBNAIL;
                                                            $fileName = $info->pictures->count()> 0 ? $info->pictures[0]->picture : $info->thumbnail;
                                                        @endphp
                                                        <img src="{{ asset($path."/".$fileName) }}"  alt="">
                                                    </div>

                                                    <div class="media-body">
                                                        <h4 class="mt-0 two_line_text">{{ $info->title }}</h4>
                                                        <p class="four_line_text">
                                                            {!!   strip_tags($info->details)  !!}
                                                        </p>
                                                        <div class="time--category--distric">
                                                            <small>{!! $info->created_at->diffForHumans() !!} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>

                                {{-- Right div 2 + 2 = 4 News start --}}
                                <div class="col-lg-6">
                                    <div class="row">
                                        @forelse($news as $key=>$info)
                                            @if(!$loop->first && $loop->iteration<=5)
                                                <div class="col-lg-6">
                                                    <div class="saradesh--short--news--here">
                                                        <a href="{{ route('asian.single-news-read',$info->slug) }}">
                                                            <div class="{{ $category->id == 18 ? "division_mediaImage" : "category_mediaImage" }}">
                                                                <img src="{{ asset(\App\Service\AsianService::POST_THUMBNAIL."/".$info->thumbnail) }}"  alt="" class="img img-circle mr-3 ">
                                                            </div>
                                                            <h5 class="two_line_text mt-2"> {{ $info->title }} </h5>
                                                            <small  style="">{!! $info->created_at->diffForHumans() !!}</small>
                                                        </a>
                                                    </div>
                                                    <hr>
                                                </div>

                                            @endif
                                        @empty
                                        @endforelse
                                    </div>

                                </div>
                                {{-- Right div 2 + 2 = 4 News end --}}


                            </div>
                            {{-- 1 Large & 4 mini end --}}

                            {{-- After First 5 news start --}}
                            <div class="row">
                                @forelse($news as $key=>$info)
                                    @if( $loop->iteration>5)
                                        <div class="col-lg-3">
                                            <div class="saradesh--short--news--here">
                                                <a href="{{ route('asian.single-news-read',$info->slug) }}">
                                                    <div class="{{ $category->id == 18 ? "division_mediaImage" : "category_mediaImage" }}">
                                                        <img src="{{ asset(\App\Service\AsianService::POST_THUMBNAIL."/".$info->thumbnail) }}"  alt="" class="img img-circle mr-3 ">
                                                    </div>
                                                    <h5 class="two_line_text mt-2"> {{ $info->title }} </h5>
                                                    <small  style=""> {!! $info->created_at->diffForHumans() !!} </small>
                                                </a>
                                            </div>
                                            <hr>
                                        </div>

                                    @endif
                                @empty
                                @endforelse
                            </div>
                            {{-- After First 5 news end --}}

                        </div>
                    </div>
                    @if($category->id == 18)
                        <div class="col-md-3 col-sm-9 col-xs-12 ajax_load_division_information">
                            <div class="right--sidebar--top--ad--section">
                                <div class="live--tv--section">
                                    <div class="dot-wrapper liveText-m__dot-wrapper__nVvxk">
                                        <div class="liveText-m__dot__3TIUh liveText-m__dot--basic__3I8R3"></div>
                                    </div>
                                    <span class="live--tv--here">Live TV</span>
                                </div>

                               @include("asian.includes.tv-link")

                            </div>
                            <div class="distric--news--section--here--content--right">
                                <div class="right--sidebar--two--ad--section">
                                    <a href="#"><img src="{{ asset('asian') }}/img/t20-world-quiz-banner-20211017141121.jpg" alt=""></a>
                                </div>
                            </div>
                            <hr>
                            <div class="jelar--sorkari--link">
                                <h4>জেলার সরকারি ওয়েব লিংক</h4>
                                <ul>
                                    @forelse($category->links as $key=>$link)
                                        <li><a href="{{ $link->link }}"> {{ $link->title }} </a></li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                            <hr>
                            <div class="dossonio--estan">
                                <h4>দর্শনীয় স্থান</h4>
                                <ul>
                                    @forelse($category->places as $key1=>$place)
                                        <li>{{ $place->title }} </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                            <hr>
                            <div class="jelar--motamot">
                                <h4>মতামত</h4>
                                <div class="owl-carousel jelar--motamot--slider owl-theme owl-loaded owl-drag">

                                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-616px, 0px, 0px); transition: all 0.9s ease 0s; width: 2464px;"><div class="owl-item cloned" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item cloned" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item active" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item cloned" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div><div class="owl-item cloned" style="width: 308px;"><div class="item">
                                                    <div class="motamot--slider">
                                                        <div class="image">
                                                            <img src="img/403019_avatar_male_man_person_user_icon.png" alt="">
                                                        </div>
                                                        <h5>মহিউদ্দিন সরকার</h5>
                                                        <small>সম্পাদক</small>
                                                        <p>ছোটবেলা থেকেই মালিহার (ছদ্মনাম) স্বাস্থ্য ভালো। কিন্তু কিছুদিন আগে একটি বিয়েতে একজন আত্মীয় বলে বসলেন মোটার কারণে মালিহাকে ভালো দেখাচ্ছে না। ব্যাপারটা তিনি হালকাভাবে বললেও এ কথা শোনার পর থেকে মালিহা আর ঘর থেকে বের হতে চায় না। এমনকি খেতেও চায় না, এ নিয়ে তার বাবা-মা বেশ চিন্তিত হয়ে পড়েন।</p>
                                                    </div>
                                                </div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
                            </div>
                            <hr>
                            <div class="jelar--itehas">
                                <h4>জেলার ইতিহাস</h4>
                                <p>
                                    @if(!empty($category->detais))
                                        {!! $category->details !!}
                                    @else
                                        No data found
                                    @endif
                                </p>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    </div>

@endsection

@section("js")
    <script>
        $(document).on("change",".view_category_news",function(){
           let category_news = $(this).val();
            if(category_news.length>0){
                loading_news(category_news);
            }
           console.log("News loading for : ",category_news);
        });


        async function loading_news(category_id){
            await $.ajax({
                method:"post",
                url:"{{ route('load.news') }}",
                data : { category_id : category_id, _token:"{{ csrf_token() }}"},
                dataType:"html",
                success:function (res) {
                    console.log("Response : ",res);
                    $(".main--news--distric").html(res);
                },
                error:function (error) {
                    console.log("Error : ",error);
                }
            })
        }

        window.current_category_id;

        $(document).on("click",".ajax_menu_news_option",function(e){
            let category_id = $(this).attr("data-category_id");

            if(window.current_category_id == undefined){
                window.current_category_id = category_id;
                loading_news(category_id);
            }else{
                if(window.current_category_id != category_id){
                    loading_news(category_id);
                }
            }
        });

    </script>
@endsection


@section("css")
<style>
    
    .jelar-page-title {
        float: left;
        padding: 0px 10px;
        overflow: hidden;
        font-size: 25px;
        background: #ffffff;
        color: #000000;
        border-radius: 10px;
        margin-right: 5px;
        font-weight: bold;
        border: 2px solid #135422;
    }

    .ajax_menu_news_option {
        display: inline-block;
        border-radius: 5px;
        margin: 2px;
        padding: 2px 10px;
        border: 1px solid;
        transition: 500ms;
        color: #fff;
        background: #135422;
        margin-top: 5px;
    }

    .main--news--distric {
        padding-top: 0px!important;
    }

    section.distric--news--here {
        padding-top: 14px!important;
    }

    .breadcrumb {
        padding: 0.25rem 1rem!important;
        background: #c300000d!important;
    }

    .breadcrumb-item{}
    .breadcrumb-item a{
        font-size: 1.3rem;
        color: #000!important;
    }
    .breadcrumb-item a i{}

    .saradesh--short--news--here {
        margin-bottom: 0px;
        height: 285px;
    }

    small{
        color: #666666;
    }

    .custom_jhelar_khobor_title {
        text-align: left;
        border-radius: 0px;
        margin-bottom: 17px;
    }


    .custom_jhelar_khobor_title ul {
        margin: 0;
       /*border: 1px solid rgba(0,0,0,0.1);*/
    /* justify-content: space-evenly; */
        justify-content: space-between!important;
        flex: auto!important;
    }

    .custom_jhelar_khobor_title ul li:first-child {
        background: white;
        text-align: left;
        color: maroon;
        font-weight: bold;
        font-size: 1.3rem;
    }

    .custom_jhelar_khobor_title ul li {
        width: 10.83%;
        display: inline-block;
    }

    .custom_jhelar_khobor_title ul li select {
        border-right: 1px solid rgba(0,0,0,0.15);
        border-left: 1px solid rgba(0,0,0,0.15);
        border-radius: 0;
    }

</style>

@endsection
