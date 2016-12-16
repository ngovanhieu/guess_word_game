<div class="row" id="chatbox">
    <div class="panel panel-primary">
        <div class="panel-heading" id="accordion">
            <span class="glyphicon glyphicon-comment"></span> {{ trans('front-end/room.chat-box') }}
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" 
                    data-parent="#accordion" href="#collapseOne">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
            </div>
        </div>
        <div class="panel-collapse collapse in" id="collapseOne">
            <div class="panel-body" id="chat-message">
                <ul class="chat" id="chat">
                    @foreach ($messages as $message)
                        <li class="{{ $message->user->isCurrent() ? 'right' : 'left' }} clearfix">
                            <span class="chat-img pull-right">
                                <img src="{{ $message->user->avatar ? asset(($message->user->avatar_url)) : 
                                    asset(config('user.default-avatar')) }}" class="chat-icon " />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted chat-time"><span class="glyphicon"></span></small>
                                    <strong class="pull-right primary-font chat-name">{{ $message->user->name }}</strong>
                                </div>
                                <p class="pull-right chat-content">
                                    {{ $message->content }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="panel-footer">
            {!! Form::open(['action' => ['Web\ChatsController@store'], 'method' =>  'POST', 'id' => 'target']) !!}
                <div class="input-group">
                    {!! Form::text('content', null, ['class' => 'form-control', 'id' => 'content-chat']) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" id="btn-chat">
                            {{ trans('front-end/room.buttons.send-message') }}
                        </button>
                    </span>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
