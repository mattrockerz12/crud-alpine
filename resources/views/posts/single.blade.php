@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            <div>
                <div class='card'>
                    <div class='card-body'>
                        <h4>Display Comments</h4>
                        <hr />
                        <h4>Add comment</h4>
                        <form>
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden"  />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Add Comment" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

