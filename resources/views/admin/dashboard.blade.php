@extends('admin.layout.index')
@section('dashboard') menu-item-active @endsection
@section('content')
@include('admin.layout.header')

<!-- Page Heading -->
<div class="row">
    <div class="col-md-2">
        <div class="card shadow mb-2 position_sticky" style="top: 60px">
        <form id="submit" action="admin/dashboard/search" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Files</h6>
            </div>
            <div class="card-body">
                <ul class="list_cat">
                    @foreach($category as $val)
                    <li><label class="container"><input class="button_submit" <?php if(isset($key_file) && in_array($val->id, $key_file)){echo 'checked';} ?> value="{{$val->id}}" name="file[]" type="checkbox" ><span class="checkmark"></span> {{$val->name}} </label></li>
                    @endforeach
                </ul>
            </div>

            <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thể loại</h6>
            </div> -->
            <div class="card-body">
                <ul class="list_cat">
                    @foreach($option as $val)
                    @if($val->sort_by=='theloai')
                    <li title="{{$val->name}}"><label class="container"><input class="button_submit" <?php if(isset($key_theloai) && in_array($val->sku, $key_theloai)){echo 'checked';} ?> value="{{$val->sku}}" name="theloai[]" type="checkbox" ><span class="checkmark"></span> {{$val->name}} </label></li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Dự án</h6>
            </div> -->
            <div class="card-body">
                <select name="duan[]" class="form-control kt_select2_1 select2 button_submit" multiple>
                    @foreach($option as $val)
                    @if($val->sort_by=='duan')
                    <option <?php if(isset($key_duan) && in_array($val->sku, $key_duan)){echo 'selected';} ?> value="{{$val->sku}}">{{$val->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Chi nhánh</h6>
            </div> -->
            <div class="card-body">
                <ul class="list_cat">
                    @foreach($option as $val)
                    @if($val->sort_by=='chinhanh')
                    <li><label class="container"><input class="button_submit" <?php if(isset($key_chinhanh) && in_array($val->sku, $key_chinhanh)){echo 'checked';} ?> value="{{$val->sku}}" name="chinhanh[]" type="checkbox" ><span class="checkmark"></span> {{$val->name}} </label></li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <button class="form-control" type="submit">Tìm kiếm</button> 
        </form>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin</h6>
            </div>
            <div class="card-body">
                <ul class="js-masonry-list test-list">
                    @foreach($articles as $val)
                    <li class="js-masonry-elm">
                        <a href="admin/dashboard/{{$val->id}}"><img src="data/news/300/{{$val->img}}" alt=""></a>
                        <div class="info">
                            <h2><a class="line-2" href="admin/dashboard/{{$val->id}}">{{$val->name}}</a></h2>
                            <p>{{$val->user->your_name}} | {{date('d/m/Y',strtotime($val->updated_at))}}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
    </div>
</div>

<style type="text/css">
    .list_cat label{ padding-left: 20px; font-size: 1.1rem; margin-bottom: 10px;     -webkit-line-clamp: 1;
    display: -webkit-box !important;
    -webkit-box-orient: vertical;
    overflow: hidden;}

    
    .js-masonry-elm{ list-style: none; position: relative; }
    .js-masonry-elm .info{ position: absolute; bottom: 0; width: 100%; background: #000000a6; padding: 5px; }
    .js-masonry-elm .info h2 { line-height: 1rem; }
    .js-masonry-elm .info p { font-size: .8rem; color: #fff; margin-bottom: 0px; }
    .js-masonry-elm .info h2 a{ font-size: 1.2rem; color: #fff; }
    .js-masonry-elm img{ width: 100%; border-radius: 5px; }
    .js-masonry-list { padding-left: 0px; }
</style>

<script type="text/javascript">
    masonry({
  target: '.js-masonry-list',
  column: 4,
  columnGap: 20, 
  rowGap: 20, 
  responsive: [ 
    {
      breakpoint: 1024,
      column: 4,
      columnGap: 40,
      rowGap: 40,
    },
    {
      breakpoint: 800,
      column: 3,
      columnGap: 30,
      rowGap: 30,
    },
    {
      breakpoint: 600,
      column: 2,
      columnGap: 20,
      rowGap: 20,
    },
    {
      breakpoint: 400,
      column: 1,
      columnGap: 0,
      rowGap: 40,
    }
  ]
});

function masonry(setOptions) {
  'use strict';

    //options
    const defaultOptions = {
        target: '.js-masonry-list', 
        column: 1,  
        columnGap: 0, 
        rowGap: 0,  
        responsive: null,
        activeClass: 'is-active',  
        listClass: '.js-masonry-list',
        listElmsClass: '.js-masonry-elm', 
    }

    const options = Object.assign({}, defaultOptions, setOptions);
    const listClass = options.listClass;
    const listElmsClass = options.listElmsClass;
    const lists = Array.prototype.slice.call(document.querySelectorAll(listClass),0);
    if(lists.length === 0) {
        return false;
    }

    masonryFunk(options);
    window.addEventListener('resize',  function() {
        masonryFunk(options);
    });

    function masonryFunk(options) {
        let column = options.column;
        let columnGap = options.columnGap;
        let rowGap = options.rowGap;
        let listWidth = null;
        const responsive = options.responsive;
        if(responsive) {
            const winWidth = window.innerWidth;
            for (let i = 0; i < responsive.length; i++) {
                if(winWidth <= responsive[i].breakpoint) {
                    column = responsive[i].column;
                    columnGap = responsive[i].columnGap;
                    rowGap = responsive[i].rowGap;
                    listWidth = responsive[i].breakpoint;
                }
            }
        }

        lists.forEach(function(list){
            const listElms = Array.prototype.slice.call(list.querySelectorAll(listElmsClass),0);
            if(listElms.length === 0) {
                return false;
            }
            if(!list.classList.contains(options.activeClass)) {
                list.style.display = 'flex';
                list.style.flexWrap = 'wrap';
                list.style.alignItems = 'flex-start';

                list.classList.add(options.activeClass);
            }
            if(!listWidth) {
                listWidth = parseFloat(getComputedStyle(list).width);
            }
            const columnGapTotal = columnGap * (column-1);
            const listElmWidth = (((listWidth - columnGapTotal)/column)/listWidth*100)+'%';
            const listColumnGap = (columnGap/listWidth*100)+'%';
            if(typeof rowGap === 'number') {
                rowGap = (rowGap/listWidth*100)+'%';
            }

            listElms.forEach(function(listElm,index){
                listElm.style.marginRight = listColumnGap;
                listElm.style.width = listElmWidth;
                listElm.style.marginBottom = rowGap;

                listElm.style.marginTop = '';
                if(column !== 1 && (index + 1) % column === 0) {
                    listElm.style.marginRight = '';
                }

                if(column > index) {
                    return;
                }

                const topListElm = listElms[index-column];
                const topListElmPosi =  topListElm.getBoundingClientRect().top;
                const topListHeight =  getHeightAndMarginBottom(topListElm);
                const topListBottomPosi = topListElmPosi + topListHeight;
                const listElmPosi =  listElm.getBoundingClientRect().top;
                let setPosi = listElmPosi.toFixed(0) - topListBottomPosi.toFixed(0);
                if(setPosi === 0) {
                    return false;
                }
                setPosi = '-' + setPosi + 'px';
                listElm.style.marginTop = setPosi;
            });
        });
    }

    function getHeightAndMarginBottom(elm) {
        const height = elm.getBoundingClientRect().height;
        const styles = getComputedStyle(elm);
        const bottom = parseFloat(styles.marginBottom);
        return height + bottom;
    }
}


</script>

@endsection
