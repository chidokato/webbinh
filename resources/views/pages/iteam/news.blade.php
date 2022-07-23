<div class="col list-news">
  <div class="card shadow-sm">
    <a class="tags" href="">{{$val->category->name}}</a>
    <a href="{{ isset($val->category->slug)? $val->category->slug : '' }}/{{$val->slug}}">
      <img class="zoom" src="data/news/{{$val->img}}">
    </a>
    <div class="card-body">
      <div class="card-text"><a href="{{ isset($val->category->slug)? $val->category->slug : '' }}/{{$val->slug}}">{{$val->name}}</a></div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
        </div>
        <div class="info-group">
          <small class="text-muted">{{$val->User->name}}</small>
          <small class="text-muted"> - {{date('d/m/Y',strtotime($val->created_at))}}</small>
        </div>
      </div>
    </div>
  </div>
</div>
