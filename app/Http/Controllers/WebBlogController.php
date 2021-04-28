<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class WebBlogController extends Controller
{
      public function index($locale)
      {
            $domain = request()->getHost();
            if ($locale == 'id') {
                  $_about  = DB::table('info')
                                          ->where('domain', $domain)
                                          ->where('lang', $locale)
                                          ->where('name', 'like', '%Informasi Perusahaan%')
                                          ->first();
            } else {
                  $_about  = DB::table('info')
                                          ->where('domain', $domain)
                                          ->where('lang', $locale)
                                          ->where('slug', 'like', '%about-ngefans%')
                                          ->first();
            }

            $_meta   = DB::table('menu')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->where('slug', 'home')
                                    ->first();

            $_menu   = DB::table('menu')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_slider = DB::table('slider')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->where('order', 1)
                                    ->first();

            $_artist = DB::table('artist_ngefans')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_fitur  = DB::table('fitur')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_blog   = DB::table('post')
                                    ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
                                    ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
                                    ->where('post.lang', $locale)
                                    ->where('post.status', 'PUBLISHED')
                                    ->where('post.domain', $domain)
                                    ->limit(2)
                                    ->latest('post.created_at')
                                    ->get();

            $_contact = DB::table('contact')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->first();

            $_other   = DB::table('other')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            return view('blog.pages.home', compact('_slider', '_about', '_fitur', '_artist', '_contact', '_other', 'locale', '_meta', 'domain', '_menu', '_blog'));
      }

      public function site($locale, $slug)
      {

            if ($slug == 'home') {
                  return $this->index($locale);
            } else {
                  return $this->page($locale, $slug);
            }
      }

      public function read($locale, $slug)
      {

            $domain = request()->getHost();

            $_menu  = DB::table('menu')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_other = DB::table('other')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_blog  = DB::table('post')
                                    ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created', 'post.meta_description', 'post.meta_keywords as meta_keyword', 'post.seo_title')
                                    ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
                                    ->where('post.lang', $locale)
                                    ->where('post.status', 'PUBLISHED')
                                    ->where('post.domain', $domain)
                                    ->where('post.slug', $slug)
                                    ->first();
            $_meta = $_blog;

            $_contact = DB::table('contact')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->first();

            $_other   = DB::table('other')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_category = DB::table('post_categories')
                                    ->where('domain', request()->getHost())
                                    ->where('lang', $locale)->get();

            return view('blog.pages.blog-detail', compact('_blog', '_category', '_contact', '_meta', 'locale', 'domain', '_menu', '_other'));
      }

      public function category($locale, $slug)
      {
            $domain = request()->getHost();

            $_menu  = DB::table('menu')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();
                                    
            $_slider = DB::table('slider')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->where('order', 5)
                                    ->first();

            $_other  = DB::table('other')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->orderBy('order', 'ASC')
                                    ->get();

            $_blog  = DB::table('post')
                                    ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
                                    ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
                                    ->where('post.lang', $locale)
                                    ->where('post.status', 'PUBLISHED')
                                    ->where('post_categories.slug', $slug)
                                    ->where('post.domain', $domain)->paginate(16);

            $_contact = DB::table('contact')
                                    ->where('domain', $domain)
                                    ->where('lang', $locale)
                                    ->first();

            $_other   = DB::table('other')->where('domain', $domain)
                  ->where('lang', $locale)
                  ->orderBy('order', 'ASC')
                  ->get();

            $_category = DB::table('post_categories')
                  ->where('domain', request()->getHost())
                  ->where('lang', $locale)->get();

            $_meta = DB::table('post_categories')
                  ->where('domain', request()->getHost())
                  ->where('slug', $slug)
                  ->where('lang', $locale)->first();

            return view('blog.pages.category', compact('_blog', '_slider', '_category', '_contact', '_meta', 'locale', 'domain', '_menu', '_other'));
      }

      public function page($locale, $slug)
      {
            $domain = request()->getHost();

            $_menu  = DB::table('menu')->where('domain', $domain)
                  ->where('lang', $locale)
                  ->orderBy('order', 'ASC')
                  ->get();

            $_other   = DB::table('other')->where('domain', $domain)
                  ->where('lang', $locale)
                  ->orderBy('order', 'ASC')
                  ->get();

            $_contact = DB::table('contact')->where('domain', $domain)->where('lang', $locale)->first();

            if ($locale == 'id' and $slug == 'tentang-ngefans') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 2)
                        ->first();

                  $_content  = DB::table('info')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', 'like', '%tentang-ngefans%')
                        ->first();

                  return view('blog.pages.about', compact('_content', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            } else if ($locale == 'en' and $slug == 'about-ngefans') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 2)
                        ->first();

                  $_content  = DB::table('info')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', 'like', '%about-ngefans%')
                        ->first();
                  return view('blog.pages.about', compact('_content', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            } else if ($locale == 'id' and $slug == 'kebijakan-privasi') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 3)
                        ->first();

                  $_content  = DB::table('other')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', 'like', '%kebijakan-privasi%')
                        ->first();
                  return view('blog.pages.about', compact('_content', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            } else if ($locale == 'en' and $slug == 'privacy-policy') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 3)
                        ->first();

                  $_content  = DB::table('other')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', 'like', '%privacy-policy%')
                        ->first();
                  return view('blog.pages.about', compact('_content', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            } else if ($locale == 'id' and $slug == 'ketentuan-kondisi') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 4)
                        ->first();

                  $_content  = DB::table('other')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', 'like', '%ketentuan-kondisi%')
                        ->first();
                  return view('blog.pages.about', compact('_content', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            } else if ($locale == 'en' and $slug == 'term-condition') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 4)
                        ->first();

                  $_content  = DB::table('other')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', 'like', '%term-condition%')
                        ->first();
                  return view('blog.pages.about', compact('_content', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            } else if ($slug == 'blog') {

                  $_meta   = DB::table('menu')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('slug', $slug)
                        ->first();

                  $_slider = DB::table('slider')->where('domain', $domain)
                        ->where('lang', $locale)
                        ->where('order', 5)
                        ->first();

                  $_blog   = DB::table('post')
                        ->select('post.*', 'post_categories.*', 'post.id', 'post_categories.name as category', 'post.slug as slugpost', 'post.created_at as created')
                        ->join('post_categories', 'post.category_id', '=', 'post_categories.id')
                        ->where('post.lang', $locale)
                        ->where('post.status', 'PUBLISHED')
                        ->where('post.domain', $domain)->paginate(16);
                  return view('blog.pages.blog', compact('_blog', '_contact', '_slider', '_meta', 'locale', 'domain', '_menu', '_other'));
            }
      }

      public function subscribed($locale, $domain)
      {
            $provinces = DB::table('provinces')->get();
            return view('auth.member-register-sub', compact('locale', 'domain', 'provinces'));
      }
      public function reserved($locale, $domain, $invoice)
      {
            $payment = DB::table('payment')->select('users.name as customer', 'master_member.name as member_name', 'payment.*')
                  ->leftJoin('users', 'users.id', '=', 'payment.user_id')
                  ->leftJoin('master_member', 'master_member.id', '=', 'payment.member_id')
                  ->where('invoice', $invoice)
                  ->first();
            return view('auth.payment-confirm', compact('local', 'domain', 'invoice', 'payment'));
      }
}