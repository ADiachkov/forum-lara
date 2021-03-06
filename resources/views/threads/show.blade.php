@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <div class="card" style="margin-bottom: 40px">
                    <div class="card-header">
                        <a href="#">{{$thread->creator->name}} </a> posted:
                        {{$thread->title}}
                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{$replies->links()}}

                @if(auth()->check())

                    <form method="POST" action="{{$thread->path().'/replies'}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" id="body" placeholder="Have something to say?"
                                      class="form-control" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                @else
                    <p class="">Please <a href="{{route('login')}}">sign in</a> to participate in this discussion.</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{$thread->created_at->diffForHumans()}} by
                            <a href="#">{{$thread->creator->name}}</a>, and currently has
                            {{$thread->replies_count}} {{Str::plural('comment', $thread->replies_count)}}.
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

