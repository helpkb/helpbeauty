<div class="row">
  <div class="col-md-8">
    <div class="form-group">
      <label for="title" class="col-md-2 control-label">
        Title
      </label>
      <div class="col-md-10">
        <input type="text" class="form-control" name="title" autofocus
               id="title" value="{{ $title }}">
      </div>
    </div>
    <div class="form-group">
      <label for="subtitle" class="col-md-2 control-label">
        Subtitle
      </label>
      <div class="col-md-10">
        <input type="text" class="form-control" name="subtitle"
               id="subtitle" value="{{ $subtitle }}">
      </div>
    </div>
    <div class="form-group">
      <label for="content" class="col-md-2 control-label">
        Content
      </label>
      <div class="col-md-10">
        <textarea name="content" class="form-control" data-provide="markdown" placeholder="Post Body" rows="14"
                  id="content">{{ $content }}</textarea>
      </div>
    </div>
  </div>
  <div class="col-md-4">

    <div class="form-group">
      <label for="module_id" class="col-md-3 control-label">
        Module Name (Category)
      </label>
      <div class="col-md-8">
        <select name="module_id" id="module" class="form-control">
            <?php //foreach ($categories as $category): ?>
               <option value=""></option>
            <?php //endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8 col-md-offset-3">
        <div class="checkbox">
          <label>
            <input {{ checked($is_draft) }} type="checkbox" name="is_draft">
            Draft?
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="tags" class="col-md-3 control-label">
        Tags
      </label>
      <div class="col-md-8">
        <select name="tags[]" id="tags" class="input-tags form-control" multiple>
          @foreach ($allTags as $tag)
            <option @if (in_array($tag, $tags)) selected @endif
            value="{{ $tag }}">
              {{ $tag }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>