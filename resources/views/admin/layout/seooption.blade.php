<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">SEO option</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title</label>
                    <input value="{{ isset($seo) ? $seo->title : '' }}{{old('title')}}" id="title" onkeyup="changetitle(this);" name='title' type="text" placeholder="70 characters left" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label >Description</label>
                    <input value="{{ isset($seo) ? $seo->description : '' }}{{old('description')}}" id="description" onkeyup="change(this);" name='description' type="text" placeholder="170 characters left" class="form-control">
                </div>
            </div>
            <div class="col-lg-9">
                <div class="form-group">
                    <label>keywords</label>
                    <input value="{{ isset($seo) ? $seo->keywords : '' }}{{old('keywords')}}" name='keywords' type="text" placeholder="keywords ..." class="form-control">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Robots</label>
                    <select name='robot' class="form-control">
                        <option <?php if(isset($seo) && $seo->robot=='index, follow'){echo "selected";} ?> <?php if(old('robot')=='index, follow'){echo"selected";} ?> value="index, follow">index, follow</option>
                        <option <?php if(isset($seo) && $seo->robot=='noindex, nofollow'){echo "selected";} ?> <?php if(old('robot')=='noindex, nofollow'){echo"selected";} ?> value="noindex, nofollow">noindex, nofollow</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body seo">
        <div class="row">
            <div class="col-md-6">
                <div class="seo-link">{{asset('')}} <span class='fa fa-caret-down'></span></div>
                <div class="seo-title"></div>
                <div class="seo-description"></div>
            </div>
        </div>
    </div>
</div>
