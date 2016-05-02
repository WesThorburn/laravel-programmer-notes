<!-- Settings Modal -->
<div id="settingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Note Settings</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="noteForm" action="{{action('NoteController@noteSettings', ['id' => $selectedNote->id])}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Make this note private.
                            </label>
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default pull-right margin-top-10px">Save</button>
                </div>
                </form>
        </div>

    </div>
</div>