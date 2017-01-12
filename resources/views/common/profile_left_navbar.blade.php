@inject('count','App\UserProfile\Profile')
<div class="col-md-3">
    <div class="search-menu-list">
        <ul class="dropDown-menu">
            <li class="item-allCategory">
                <p>
                    <i class="fa fa-fw fa-th-large" style="color: #1678c2;"></i>
                    <a href="/u/{{$profile->user->name}}/timeLine">我的时光轴</a>
                </p>
            </li>
            <li class="dropdown-separator"></li>
            <li class="item-category">
                <a id="profile-posts-list" href="/u/{{$profile->user->name}}/posts">
                    <span><i class="fa fa-fw fa-square" style="color: #EF6733;"></i></span>
                    我的帖子
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->postsCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-articles-list" href="/u/{{$profile->user->name}}/articles">
                    <span><i class="fa fa-fw fa-square" style="color: #7088a9;"></i></span>
                    我的文章
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->articlesCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-answers-list" href="/u/{{$profile->user->name}}/answers">
                    <span><i class="fa fa-fw fa-square" style="color: #09d7c1;"></i></span>
                    我的回答
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->answersCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-followings-list" href="/u/{{$profile->user->name}}/followings">
                    <span><i class="fa fa-fw fa-square" style="color: #5829bb;"></i></span>
                    我的粉丝
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        36
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-followers-list" href="/u/{{$profile->user->name}}/followers">
                    <span><i class="fa fa-fw fa-square" style="color: #d01919;"></i></span>
                    我关注的人
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        204
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>