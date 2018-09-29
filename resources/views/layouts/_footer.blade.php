<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <p class="text-md-left text-sm-left text-xs-left"><a href="https://julialang.org/" target="_blank">Julia</a></p>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <?php
                    $extra_class = $_SERVER['REQUEST_URI'] !== '/' ? 'hidden-xs hidden-sm' : '';
                ?>

                <p class="text-md-center text-sm-left text-xs-left {{ $extra_class  }}">
                    @if ($_SERVER['REQUEST_URI'] === '/')
                        Special thanks to <a href="http://github.com/summerblue/" target="_blank">SummerBlue</a>
                    @endif
                </p>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <p class="text-lg-right text-md-right text-sm-left text-xs-left"><a href="http://www.nagexiucai.com/">那个秀才</a></p>
            </div>
        </div>
    </div>
</footer>