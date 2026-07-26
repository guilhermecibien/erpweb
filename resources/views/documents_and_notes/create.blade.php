<div class="modal-dialog modal-lg" role="document">
    @php
    $__f1 = ['options' => ['action' => 'DocumentAndNoteController@store', 'id' => 'docus_notes_form', 'method' => 'post']];
    @endphp
    <x-form.open :options="$__f1['options']" />
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                @lang('lang_v1.add_note')
            </h4>
        </div>
        <!-- model id like project_id, user_id -->
        @php
        $__f2 = ['name' => 'notable_id', 'value' => $notable_id, 'options' => ['class' => 'form-control']];
        @endphp
        <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
        <!-- model name like App\User -->
        @php
        $__f3 = ['name' => 'notable_type', 'value' => $notable_type, 'options' => ['class' => 'form-control']];
        @endphp
        <x-form.input type="hidden" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                        @php
                        $__f4 = ['name' => 'heading', 'value' => __('lang_v1.heading') . ':*'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'heading', 'value' => null, 'options' => ['class' => 'form-control', 'required' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        @php
                        $__f6 = ['name' => 'description', 'value' => __('lang_v1.description') . ':'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'description', 'value' => null, 'options' => ['class' => 'form-control ', 'id' => 'docs_note_description']];
                        @endphp
                        <x-form.textarea :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fileupload">
                            @lang('lang_v1.documents'):
                        </label>
                        <div class="dropzone" id="docusUpload"></div>
                    </div>
                    <input type="hidden" id="docus_notes_media" name="file_name[]" value="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_private" value="1"> @lang('lang_v1.is_private')
                                <i class="fa fa-info-circle" data-toggle="tooltip" title="@lang('lang_v1.note_will_be_visible_to_u_only')"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                @lang('messages.save')
            </button>
             <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                @lang('messages.close')
            </button>
        </div>
    </div><!-- /.modal-content -->
    <x-form.close />
</div><!-- /.modal-dialog -->