<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dealer Inspire Code Challenge</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- Custom CSS for form styles -->
    <link href="css/main.css" rel="stylesheet">

    <!-- logging through rollbar-->
    <script>
      var _rollbarConfig = {
        accessToken: "61f7e3f739c1407f87e1b49fee8d9ddf",
        captureUncaught: true,
        captureUnhandledRejections: true,
        payload: {
          environment: "staging"
        }
      };
      // Rollbar Snippet
      !function(r){var e={};function o(n){if(e[n])return e[n].exports;var t=e[n]={i:n,l:!1,exports:{}};return r[n].call(t.exports,t,t.exports,o),t.l=!0,t.exports}o.m=r,o.c=e,o.d=function(r,e,n){o.o(r,e)||Object.defineProperty(r,e,{enumerable:!0,get:n})},o.r=function(r){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(r,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(r,"__esModule",{value:!0})},o.t=function(r,e){if(1&e&&(r=o(r)),8&e)return r;if(4&e&&"object"==typeof r&&r&&r.__esModule)return r;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:r}),2&e&&"string"!=typeof r)for(var t in r)o.d(n,t,function(e){return r[e]}.bind(null,t));return n},o.n=function(r){var e=r&&r.__esModule?function(){return r.default}:function(){return r};return o.d(e,"a",e),e},o.o=function(r,e){return Object.prototype.hasOwnProperty.call(r,e)},o.p="",o(o.s=0)}([function(r,e,o){var n=o(1),t=o(4);_rollbarConfig=_rollbarConfig||{},_rollbarConfig.rollbarJsUrl=_rollbarConfig.rollbarJsUrl||"https://cdnjs.cloudflare.com/ajax/libs/rollbar.js/2.11.0/rollbar.min.js",_rollbarConfig.async=void 0===_rollbarConfig.async||_rollbarConfig.async;var a=n.setupShim(window,_rollbarConfig),l=t(_rollbarConfig);window.rollbar=n.Rollbar,a.loadFull(window,document,!_rollbarConfig.async,_rollbarConfig,l)},function(r,e,o){var n=o(2);function t(r){return function(){try{return r.apply(this,arguments)}catch(r){try{console.error("[Rollbar]: Internal error",r)}catch(r){}}}}var a=0;function l(r,e){this.options=r,this._rollbarOldOnError=null;var o=a++;this.shimId=function(){return o},"undefined"!=typeof window&&window._rollbarShims&&(window._rollbarShims[o]={handler:e,messages:[]})}var i=o(3),d=function(r,e){return new l(r,e)},s=function(r){return new i(d,r)};function c(r){return t(function(){var e=Array.prototype.slice.call(arguments,0),o={shim:this,method:r,args:e,ts:new Date};window._rollbarShims[this.shimId()].messages.push(o)})}l.prototype.loadFull=function(r,e,o,n,a){var l=!1,i=e.createElement("script"),d=e.getElementsByTagName("script")[0],s=d.parentNode;i.crossOrigin="",i.src=n.rollbarJsUrl,o||(i.async=!0),i.onload=i.onreadystatechange=t(function(){if(!(l||this.readyState&&"loaded"!==this.readyState&&"complete"!==this.readyState)){i.onload=i.onreadystatechange=null;try{s.removeChild(i)}catch(r){}l=!0,function(){var e;if(void 0===r._rollbarDidLoad){e=new Error("rollbar.js did not load");for(var o,n,t,l,i=0;o=r._rollbarShims[i++];)for(o=o.messages||[];n=o.shift();)for(t=n.args||[],i=0;i<t.length;++i)if("function"==typeof(l=t[i])){l(e);break}}"function"==typeof a&&a(e)}()}}),s.insertBefore(i,d)},l.prototype.wrap=function(r,e,o){try{var n;if(n="function"==typeof e?e:function(){return e||{}},"function"!=typeof r)return r;if(r._isWrap)return r;if(!r._rollbar_wrapped&&(r._rollbar_wrapped=function(){o&&"function"==typeof o&&o.apply(this,arguments);try{return r.apply(this,arguments)}catch(o){var e=o;throw e&&("string"==typeof e&&(e=new String(e)),e._rollbarContext=n()||{},e._rollbarContext._wrappedSource=r.toString(),window._rollbarWrappedError=e),e}},r._rollbar_wrapped._isWrap=!0,r.hasOwnProperty))for(var t in r)r.hasOwnProperty(t)&&(r._rollbar_wrapped[t]=r[t]);return r._rollbar_wrapped}catch(e){return r}};for(var p="log,debug,info,warn,warning,error,critical,global,configure,handleUncaughtException,handleAnonymousErrors,handleUnhandledRejection,captureEvent,captureDomContentLoaded,captureLoad".split(","),u=0;u<p.length;++u)l.prototype[p[u]]=c(p[u]);r.exports={setupShim:function(r,e){if(r){var o=e.globalAlias||"Rollbar";if("object"==typeof r[o])return r[o];r._rollbarShims={},r._rollbarWrappedError=null;var a=new s(e);return t(function(){e.captureUncaught&&(a._rollbarOldOnError=r.onerror,n.captureUncaughtExceptions(r,a,!0),e.wrapGlobalEventHandlers&&n.wrapGlobals(r,a,!0)),e.captureUnhandledRejections&&n.captureUnhandledRejections(r,a,!0);var t=e.autoInstrument;return!1!==e.enabled&&(void 0===t||!0===t||"object"==typeof t&&t.network)&&r.addEventListener&&(r.addEventListener("load",a.captureLoad.bind(a)),r.addEventListener("DOMContentLoaded",a.captureDomContentLoaded.bind(a))),r[o]=a,a})()}},Rollbar:s}},function(r,e){function o(r,e,o){if(e.hasOwnProperty&&e.hasOwnProperty("addEventListener")){for(var n=e.addEventListener;n._rollbarOldAdd&&n.belongsToShim;)n=n._rollbarOldAdd;var t=function(e,o,t){n.call(this,e,r.wrap(o),t)};t._rollbarOldAdd=n,t.belongsToShim=o,e.addEventListener=t;for(var a=e.removeEventListener;a._rollbarOldRemove&&a.belongsToShim;)a=a._rollbarOldRemove;var l=function(r,e,o){a.call(this,r,e&&e._rollbar_wrapped||e,o)};l._rollbarOldRemove=a,l.belongsToShim=o,e.removeEventListener=l}}r.exports={captureUncaughtExceptions:function(r,e,o){if(r){var n;if("function"==typeof e._rollbarOldOnError)n=e._rollbarOldOnError;else if(r.onerror){for(n=r.onerror;n._rollbarOldOnError;)n=n._rollbarOldOnError;e._rollbarOldOnError=n}e.handleAnonymousErrors();var t=function(){var o=Array.prototype.slice.call(arguments,0);!function(r,e,o,n){r._rollbarWrappedError&&(n[4]||(n[4]=r._rollbarWrappedError),n[5]||(n[5]=r._rollbarWrappedError._rollbarContext),r._rollbarWrappedError=null),e.handleUncaughtException.apply(e,n),o&&o.apply(r,n)}(r,e,n,o)};o&&(t._rollbarOldOnError=n),r.onerror=t}},captureUnhandledRejections:function(r,e,o){if(r){"function"==typeof r._rollbarURH&&r._rollbarURH.belongsToShim&&r.removeEventListener("unhandledrejection",r._rollbarURH);var n=function(r){var o,n,t;try{o=r.reason}catch(r){o=void 0}try{n=r.promise}catch(r){n="[unhandledrejection] error getting `promise` from event"}try{t=r.detail,!o&&t&&(o=t.reason,n=t.promise)}catch(r){}o||(o="[unhandledrejection] error getting `reason` from event"),e&&e.handleUnhandledRejection&&e.handleUnhandledRejection(o,n)};n.belongsToShim=o,r._rollbarURH=n,r.addEventListener("unhandledrejection",n)}},wrapGlobals:function(r,e,n){if(r){var t,a,l="EventTarget,Window,Node,ApplicationCache,AudioTrackList,ChannelMergerNode,CryptoOperation,EventSource,FileReader,HTMLUnknownElement,IDBDatabase,IDBRequest,IDBTransaction,KeyOperation,MediaController,MessagePort,ModalWindow,Notification,SVGElementInstance,Screen,TextTrack,TextTrackCue,TextTrackList,WebSocket,WebSocketWorker,Worker,XMLHttpRequest,XMLHttpRequestEventTarget,XMLHttpRequestUpload".split(",");for(t=0;t<l.length;++t)r[a=l[t]]&&r[a].prototype&&o(e,r[a].prototype,n)}}}},function(r,e){function o(r,e){this.impl=r(e,this),this.options=e,function(r){for(var e=function(r){return function(){var e=Array.prototype.slice.call(arguments,0);if(this.impl[r])return this.impl[r].apply(this.impl,e)}},o="log,debug,info,warn,warning,error,critical,global,configure,handleUncaughtException,handleAnonymousErrors,handleUnhandledRejection,_createItem,wrap,loadFull,shimId,captureEvent,captureDomContentLoaded,captureLoad".split(","),n=0;n<o.length;n++)r[o[n]]=e(o[n])}(o.prototype)}o.prototype._swapAndProcessMessages=function(r,e){var o,n,t;for(this.impl=r(this.options);o=e.shift();)n=o.method,t=o.args,this[n]&&"function"==typeof this[n]&&("captureDomContentLoaded"===n||"captureLoad"===n?this[n].apply(this,[t[0],o.ts]):this[n].apply(this,t));return this},r.exports=o},function(r,e){r.exports=function(r){return function(e){if(!e&&!window._rollbarInitialized){for(var o,n,t=(r=r||{}).globalAlias||"Rollbar",a=window.rollbar,l=function(r){return new a(r)},i=0;o=window._rollbarShims[i++];)n||(n=o.handler),o.handler._swapAndProcessMessages(l,o.messages);window[t]=n,window._rollbarInitialized=!0}}}}]);
      // End Rollbar Snippet
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> <span class="light">Dealer</span> Inspire Challenge
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#coffee">Coffee</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Challenge</h1>
                        <p class="intro-text">Code Something Awesome.
                            <br>We &lt;3 PHP Developers.</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About This Challenge</h2>
                <p>We make awesome things at Dealer Inspire.  We'd like you to join us.  That's why we made this page.  Are you ready to join the team?</p>
                <p>To take the code challenge, visit <a href="https://bitbucket.org/dealerinspire/php-contact-form">this Git Repo</a> to clone it and start your work.</p>
            </div>
        </div>
    </section>

    <section id="coffee" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Coffee Break?</h2>
                    <p>Take a coffee break.  You deserve it.</p>
                    <a href="https://www.youtube.com/dealerinspire" class="btn btn-default btn-lg">or Watch YouTube</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" id="contact-column">
                <h2>Contact Guy Smiley</h2>
                <p>Remember Guy Smiley?  Yeah, he wants to hear from you.</p>
                <p class="bg-primary">
                    <form id="contact-form" data-parsley-validate="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="name">
                              <label for="name">Full Name*</label>
                              <input type="text" class="form-control input-lg" placeholder="Your name here" required="" data-parsley-trigger="change">
                              <span class="field-message"> </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="email">
                              <label for="email">Email address*</label>
                              <input type="email" class="form-control input-lg" placeholder="Email" required="" data-parsley-trigger="change">
                              <span class="field-message"> </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="phone">
                              <label for="phone">Phone Number</label>
                              <input type="text" class="form-control input-lg" placeholder="555-555-5555" required>
                              <span class="field-message"> </span>
                            </div>
                        </div>
                    </div>
                        <div class="form-group" id="message">
                          <label for="message">Message*</label>
                          <textarea
                            rows="6"
                            name="message"
                            type="text"
                            class="form-control input-lg"
                            placeholder="Your message here"
                            required=""
                            data-parsley-trigger="keyup"
                            data-parsley-minlength="10"
                            data-parsley-maxlength="100"
                            data-parsley-minlength-message="Come on! You need to enter at least a 10 character message.."
                            data-parsley-validation-threshold="1"></textarea>
                          <input type="text" class="pot form-control input-lg" name="pot" id="pot">
                          <span class="field-message"></span>
                        </div>
                        <button id="primary-form-btn" class="btn btn-default">Submit</button>
                        <p class="db-message"></p>
                      </form>
                </p>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p><small>Copyright 2018 Dealer Inspire</small></p>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- jQuery form validation -->
    <script src="vendor/parsley/parsley.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script> -->

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>

    <!-- Bundled JavaScript -->
    <script src="js/main.js"></script>

</body>

</html>
