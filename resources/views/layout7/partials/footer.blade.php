<!-- BEGIN: Footer-->
    @if(!is_null(Auth::user()->footer_color))
    <footer id="piePagina" class="page-footer footer  gradient-shadow navbar-border navbar-shadow {{ (Auth::user()->footer_fija == 1)? 'footer-fixed' : 'footer-static'}}  {{(Auth::user()->footer_color)}} {{ (Auth::user()->footer_ocultar == 1)? 'hide' : ''}}" style="z-index: 3; padding-left: 0px;">
    @else
    <footer id="piePagina" class="page-footer footer footer-dark  gradient-shadow navbar-border navbar-shadow {{ (Auth::user()->footer_fija == 1)? 'footer-fixed' : 'footer-static'}}  gradient-45deg-light-blue-cyan {{ (Auth::user()->footer_ocultar == 1)? 'hide' : ''}}" style="z-index: 3; padding-left: 0px;">
    @endif
      <div class="footer-copyright">
        <div class="container">
        	<div class="container">
        		<span class="right">
	              Powered by <a class="colorInnova" style="{{(trim(Auth::user()->footer_color) == 'footer-light')? 'black' : '#fafafa' }}; font-style: normal;" href="http://innova-tec.me" target="_blank" > 
	              <b style="color: {{(trim(Auth::user()->footer_color) == 'footer-light')? 'black' : '#fafafa' }}; font-style: normal;" class="colorInnova" >INNOVA</b>TEC</a>
	            </span>

	           
        	</div>
        </div>
      </div>
    </footer>

    <!-- END: Footer-->