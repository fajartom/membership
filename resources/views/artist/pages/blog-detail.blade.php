@extends('artist.layout.default')
@section('content')

<!-- Content
      <link rel="stylesheet" href="{{asset('artist/css/modern-blog/modern-blog.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/modern-blog/css/fonts.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('artist/css/colors.php?color=dc3545')}}" type="text/css" />
    ============================================= -->
<section id="content" class="bg-light" style="width: 100%">

    <div class="content-wrap pt-lg-0 pt-xl-0 pb-0">

        <div class="container clearfix">
            @if(count($_post)>0)
            @foreach($_post as $key=> $post)
            <div class="heading-block nobottomborder center pt-4 mb-3">
                <h3 class="titlex">{{$post->title}}</h3>
            </div>

            <!-- Posts
          ============================================= -->
            <div class="single-post nobottommargin">

                <!-- Single Post
            ============================================= -->
                <div class="entry clearfix">


                    <!-- Entry Meta
              ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li class="mr-3"><i class="icon-calendar3"></i></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Image
              ============================================= -->
                    <div class="entry-image bottommargin">
                        <a href="#"><img src="{{asset("storage/artikel/$post->image")}}" alt="Blog Single"></a>
                    </div><!-- .entry-image end -->

                    <!-- Entry Content
              ============================================= -->
                    <div class="entry-content notopmargin text-justify">
                        {!! $post->body !!}
                        <div id="p-carousel" class="widget clearfix">
                            <div id="oc-portfolio-sidebar"
                                class="owl-carousel carousel-widget owl-loaded owl-drag with-carousel-dots"
                                data-items="{{count($_media)-1}}" data-animate-in="zoomIn" data-loop="true" data-nav="true" data-autoplay="5000">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-750px, 0px, 0px); transition: all 0.25s ease 0s; width: 1500px;">
                                        @foreach($_media as $media)
                                        @if($media->file!=null)
                                        @if(substr($media->file, -3)!='mp4')
                                        <div class="owl-item" style="width: 240px; margin-right: 10px;">
                                            <div class="oc-item">
                                                <div class="iportfolio">
                                                    <div class="portfolio-image">
                                                        <a href="portfolio-single.html">
                                                            <img src="{{asset("storage/media/$media->file")}}" alt="Open Imagination">
                                                        </a>
                                                        <div class="portfolio-overlay">
                                                            <a href="{{asset("storage/media/$media->file")}}" class="center-icon"
                                                                data-lightbox="image"><i class="icon-line-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="owl-item" style="width: 240px; margin-right: 10px;">
                                            <div class="oc-item">
                                                <div class="iportfolio">
                                                    <div class="portfolio-image">
                                                        <a href="portfolio-single.html">
                                                        <video width="100%" controls>
                                                          <source src="{{asset("storage/media/$media->file")}}" type="video/mp4">
                                                        </video>
                                                        </a>
                                                        <div class="portfolio-overlay">
                                                            <a href="{{asset("storage/media/$media->file")}}" class="center-icon"
                                                                data-lightbox="iframe"><i class="icon-line-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        @if(substr($media->link, -3)!='mp4')
                                        <div class="owl-item" style="width: 240px; margin-right: 10px;">
                                            <div class="oc-item">
                                                <div class="iportfolio">
                                                    <div class="portfolio-image">
                                                        <a href="portfolio-single.html">
                                                            <img src="{{$media->link}}" alt="Open Imagination">
                                                        </a>
                                                        <div class="portfolio-overlay">
                                                            <a href="{{$media->link}}" class="center-icon"
                                                                data-lightbox="image"><i class="icon-line-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="owl-item" style="width: 240px; margin-right: 10px;">
                                            <div class="oc-item">
                                                <div class="iportfolio">
                                                    <div class="portfolio-image">
                                                        <a href="portfolio-single.html">
                                                        <video width="100%" controls>
                                                          <source src="{{$media->link}}" type="video/mp4">
                                                        </video>
                                                        </a>
                                                        <div class="portfolio-overlay">
                                                            <a href="{{$media->link}}" class="center-icon"
                                                                data-lightbox="iframe"><i class="icon-line-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        <!-- Post Single - Content End -->

                        <!-- Tag Cloud
                ============================================= -->
                        <div class="tagcloud clearfix bottommargin mt-5">
                            @foreach($_category as $value)
                            <a href="{{route('category', [$locale, $value->slug])}}">
                                <div>{{$value->name}}</div>
                            </a>
                            @endforeach
                        </div><!-- .tagcloud end -->

                        <div class="clear"></div>

                        <!-- Post Single - Share
                ============================================= 
                <div class="si-share noborder clearfix">
                 <span>Share this Post:</span>
                  <div>
                    <a href="#" class="social-icon si-borderless si-facebook">
                      <i class="icon-facebook"></i>
                      <i class="icon-facebook"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-twitter">
                      <i class="icon-twitter"></i>
                      <i class="icon-twitter"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-pinterest">
                      <i class="icon-pinterest"></i>
                      <i class="icon-pinterest"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-gplus">
                      <i class="icon-gplus"></i>
                      <i class="icon-gplus"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-rss">
                      <i class="icon-rss"></i>
                      <i class="icon-rss"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-email3">
                      <i class="icon-email3"></i>
                      <i class="icon-email3"></i>
                    </a>
                  </div
                </div>Post Single - Share End -->

                    </div>
                </div><!-- .entry end -->

                <!-- Post Navigation
            ============================================= -->
                <!-- .post-navigation end -->



                <!-- Post Author Info
            ============================================= -->


                <div class="line"></div>

                <h4>Related Posts:</h4>

                <div class="mb-5 related-posts clearfix">

                    <div class="col nobottommargin">
                        @foreach($_related as $related)
                        <div class="mpost clearfix">
                            <div class="entry-image">
                                <a href="#"><img src="{{asset("storage/artikel/$related->image")}}"
                                        alt="Blog Single"></a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h4><a
                                            href="{{route('detail', [$locale,$related->slugpost])}}">{{$related->title}}</a>
                                    </h4>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> {{$related->created}}</li>
                                </ul>
                                <div class="entry-content">{!! $related->excerpt !!}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Comments
            ============================================= 
            <div id="comments" class="clearfix">

              <h3 id="comments-title"><span>3</span> Comments</h3>

               Comments List
              ============================================= 
              <ol class="commentlist clearfix">

                <li class="comment even thread-even depth-1" id="li-comment-1">

                  <div id="comment-1" class="comment-wrap clearfix">

                    <div class="comment-meta">

                      <div class="comment-author vcard">

                        <span class="comment-avatar clearfix">
                        <img alt="" src="http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60" class="avatar avatar-60 photo avatar-default" height="60" width="60"></span>

                      </div>

                    </div>

                    <div class="comment-content clearfix">

                      <div class="comment-author">John Doe<span><a href="#" title="Permalink to this comment">April 24, 2012 at 10:46 am</a></span></div>

                      <p>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                      <a class="comment-reply-link" href="#"><i class="icon-reply"></i></a>

                    </div>

                    <div class="clear"></div>

                  </div>


                  <ul class="children">

                    <li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">

                      <div id="comment-3" class="comment-wrap clearfix">

                        <div class="comment-meta">

                          <div class="comment-author vcard">

                            <span class="comment-avatar clearfix">
                            <img alt="" src="http://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=40&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D40&amp;r=G" class="avatar avatar-40 photo" height="40" width="40"></span>

                          </div>

                        </div>

                        <div class="comment-content clearfix">

                          <div class="comment-author"><a href="#" rel="external nofollow" class="url">SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                          <p>Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                          <a class="comment-reply-link" href="#"><i class="icon-reply"></i></a>

                        </div>

                        <div class="clear"></div>

                      </div>

                    </li>

                  </ul>

                </li>

                <li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">

                  <div id="comment-2" class="comment-wrap clearfix">

                    <div class="comment-meta">

                      <div class="comment-author vcard">

                        <span class="comment-avatar clearfix">
                        <img alt="" src="http://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G" class="avatar avatar-60 photo" height="60" width="60"></span>

                      </div>

                    </div>

                    <div class="comment-content clearfix">

                      <div class="comment-author"><a href="http://themeforest.net/user/semicolonweb" rel="external nofollow" class="url">SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                      <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                      <a class="comment-reply-link" href="#"><i class="icon-reply"></i></a>

                    </div>

                    <div class="clear"></div>

                  </div>

                </li>

              </ol>.commentlist end -->

                <div class="clear"></div>

                <!-- Comment Form
              ============================================= 
              <div id="respond" class="clearfix">

                <h3>Leave a <span>Comment</span></h3>

                <form class="clearfix" action="#" method="post" id="commentform">

                  <div class="col_one_third">
                    <label for="author">Name</label>
                    <input type="text" name="author" id="author" value="" size="22" tabindex="1" class="sm-form-control">
                  </div>

                  <div class="col_one_third">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="" size="22" tabindex="2" class="sm-form-control">
                  </div>

                  <div class="col_one_third col_last">
                    <label for="url">Website</label>
                    <input type="text" name="url" id="url" value="" size="22" tabindex="3" class="sm-form-control">
                  </div>

                  <div class="clear"></div>

                  <div class="col_full">
                    <label for="comment">Comment</label>
                    <textarea name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
                  </div>

                  <div class="col_full nobottommargin">
                    <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin">Submit Comment</button>
                  </div>

                </form>

              </div>#respond end -->

            </div><!-- #comments end -->
            @endforeach
            @endif
        </div>
    </div>
    </div>


    <!-- Infinity Scroll Loader
          ============================================= -->

    </div>



    </div>


    @stop