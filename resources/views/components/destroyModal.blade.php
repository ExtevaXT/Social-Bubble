<div class="modal fade" tabindex="-1" id="getOpenDestroyModalWindow">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title">Remove friend</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="getOpenDestroyModalWindow_context">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                {{--                    ПОДСТАВКА ACTION АВТОМАТИЧЕСКИ ЧЕРЕЗ JS--}}
                <form method="POST" id="getOpenDestroyModalWindow_operation">
                    @csrf
                    <input class="friendLogin" type="hidden" name="friend" value="">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

