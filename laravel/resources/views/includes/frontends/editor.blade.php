<!-- begin comment-section -->
<div class="m-t-40">
    @php
        if($editor==='normalEditor'){
            $action=route('blogs.store');
        }elseif($editor==='simpleEditor'){
            $action=route("comments.store",$blog->id);
        }elseif($editor==='updateEditor'){
            $action=route("blogs.update",$editor_blog->id);
        }
    @endphp
    <form  method="POST" action="{{ $action }}" data-parsley-validate="true"  >
        @csrf
        @if($editor!=='simpleEditor')
         <div id="hide-title">
        <label class="col-form-label" for="fullname">标题 * :</label>
        <div class="form-group row m-b-15">
            <div class="col-md-12 col-lg-12">
                @if($editor==='updateEditor')
                    @method("PUT")
                <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Required"
                       data-parsley-required="true" value="{{isset($editor_blog->title)?$editor_blog->title:""}}" disabled/>
                 @else
                    <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Required"
                           data-parsley-required="true"/>
                 @endif
            </div>
        </div>
         </div>
        @endif
        <label class="col-form-label" for="content">{{($editor==='simpleEditor')?'发表回复':'正文'}} :</label>
        <div class="form-group row m-b-15">
            <div class="col-md-12 col-sm-12">
                {{--<textarea class="summernote" name="content"></textarea>--}}
                <textarea id="my-editor" rows="10" name="content" >{!! isset($editor_blog->body)?$editor_blog->body:"" !!}</textarea>
                {{--<textarea class="summernote" name="content"></textarea>--}}
            </div>
        </div>

        <div class="form-group row m-b-0">
            <div class="col-md-12 col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>
<!-- end comment-section -->