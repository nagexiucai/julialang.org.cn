@component('mail::message')
# 欢迎，{{ $name }}：

欢迎注册朱华社区，朱华社区致力于Julia语言在zh-cn区域的推广，希望您在发帖、评论的时候遵守当地政策法规，期待您的活跃表现:)!

@component('mail::button', ['url' => 'http://julialang.org.cn/', 'color' => 'blue', 'target' => '_blank'])
    前往朱华社区
@endcomponent

祝您愉快!

[{{ config('app.name') }}](http://julialang.org.cn/)

@endcomponent
