<form action="{{$action}}" method="POST" enctype="multipart/form-data">
  @csrf
    <div class="form-group">
      <label for="">Title</label>
                                                                                                                                        <!-- Edit                    Create -->
      <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" name="title" value="{{isset($post) ? old('title', $post->title ): old('title')}}">
      <div class="invalid-feedback">
        {{$errors->first('title')}}
      </div>
    </div>
    <div class="form-group">
      <label for="">Body</label>
      <textarea name="body" id="" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{isset($post) ? old('body', $post->body): old('body')}}</textarea>
      <div class="invalid-feedback">
        {{$errors->first('body')}}
      </div>
    </div>
    @if(isset($post))
    <div class="form-group">
      <label for="">Slug</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3">{{config('app.url').'/'}}</span>
        </div>
      <input type="text" class="form-control {{$errors->has('slug') ? 'is-invalid':''}}" name="slug" value="{{isset($post) ? old('post', $post->slug):''}}">
      <div class="invalid-feedback">
        {{$errors->first('slug')}}
      </div>
    </div>
    </div>
    @endif
    <div class="form-gorup">
      <label for="">Visibility:</label>
    <br/>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="published" id="published" value="1" {{isset($post) && $post->published ? 'checked':''}}>
        <label class="form-check-label" for="published">Publish</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="published" id="published" value="0" {{isset($post) && !$post->published ? 'checked':''}}>
        <label class="form-check-label" for="published">Draft</label>
      </div>
    </div>

    <div class ="form-group">
      <label for="">Cover Image</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input {{$errors->has('cover_img') ? 'is-invalid' : ''}}" id="cover_img" name="cover_img">
        <label class="custom-file-label" for="cover_img">Choose file</label>
        <div class="invalid-feedback">
          {{$errors->first('cover_img')}}
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="">Category</label>
      <select name="categories[]" id="" class="form-control" multiple>
        @foreach($categories as $id => $name)
        <option value="{{$id}}" {{isset($post->categories) && $post->categories->contains($id) ? 'selected' : ''}}>{{$name}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    <a href="{{route('posts_index')}}" class="btn btn-link">Cancel</a>
</form>
