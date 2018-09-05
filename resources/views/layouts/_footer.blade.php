<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12"><p>由 <a href="http://www.dodcode.com" target="_blank">dodcode</a> 提供技术支持 <span style="color: #e27575;font-size: 14px;">❤</span></p></div>
            <div class="col-md-4 hidden-sm hidden-xs">
                <p style="text-align:center">
                    @if ($_SERVER['REQUEST_URI'] === '/')
                        感谢<a href="https://github.com/summerblue/larabbs" target="_blank">LaraBBS</a>
                    @endif
                </p>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12" style="text-align: right"><p><a href="mailto:{{ setting('contact_email') }}">联系我们</a></p></div>
        </div>
    </div>
</footer>