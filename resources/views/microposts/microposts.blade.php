<ul class="media-list" style="margin-top:10px">
    @foreach ($microposts as $micropost)
        <?php $user = $micropost->user; ?>
        <li class="media">
            <div class="media-left">
                <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
            </div>
            
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {!! $micropost->created_at !!}</span> 
                </div>
                <div>
                    <p2>{!! nl2br(e($micropost->content)) !!}</p2>
                </div>
                <div>
                    @if (Auth::user()->is_favoriting($micropost->id))
                        {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id], 'style' => 'display:inline-block']) !!}
                            {!! Form::submit('Unfavorite', ['class' => 'btn btn-success btn-xs']) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['micropost.favorite', $micropost->id], 'style' => 'display:inline-block']) !!}
                            {!! Form::submit('Favorite', ['class' => 'btn btn-success btn-xs']) !!}
                        {!! Form::close() !!}
                    @endif
                    
                    @if (Auth::id() === $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete', 'style' => 'display:inline-block']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>

{!! $microposts->render() !!}