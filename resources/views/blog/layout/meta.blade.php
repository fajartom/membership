  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @if(count($_meta)>0)
  <meta name="description" content="{{$_meta->meta_description}}">
  <meta name="author" content="{{$_meta->domain}}">
  <meta name="title" content="{{$_meta->seo_title}}">
  <meta name="keyword" content="{{$_meta->meta_keyword}}">
  @else
  <meta name="description" content="Welcome in fans managament site">
  <meta name="author" content="Ngefans">
  <meta name="title" content="Ngefans">
  <meta name="keyword" content="Fans managament, Fans">
  @endif

  <title>{{isset($_meta->seo_title) ? $_meta->seo_title : 'Ngefans'}}</title>