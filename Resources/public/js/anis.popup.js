
// Classe principal
function Anis(data, options) {

  var _this = this;
  _this.options = jQuery.extend({}, Anis.prototype.options, options || {});

  _this.anis = jQuery(_this.template);
  _this.setContent(data);

  if(_this.options.title == null) {

    jQuery('.anis-titlebox', _this.anis).remove();

  } else {

    jQuery('.anis-title', _this.anis).append(_this.options.title);

    if(_this.options.buttons.length === 0 && !_this.options.autoclose) {

      if(_this.options.closeButton) {
        var close = jQuery('<span class="anis-closebtn"></span>');
        close.bind('click', function() {
          _this.hide();
        });

        jQuery('.anis-titlebox', this.anis).prepend(close);

      };

    };

    if(_this.options.titleClass != null) jQuery('.anis-titlebox', this.anis).addClass(_this.options.titleClass);

  };

  if(_this.options.width != null) jQuery('.anis-box', _this.anis).css('width', _this.options.width);

  if(_this.options.buttons.length > 0) {

    for (var i = 0; i < _this.options.buttons.length; i++) {

      var cls = (_this.options.buttons[i]["class"]) ? _this.options.buttons[i]["class"] : '';
      var btn = jQuery('<div class="btnbox"><button class="btn ' + cls + '" href="#">' + _this.options.buttons[i].label + '</button></div>').data('value', _this.options.buttons[i].val);
      btn.bind('click', function() {
        var value = jQuery.data(this, 'value');
        var after = (_this.options.callback != null) ? function() { _this.options.callback(value); } : null;
        _this.hide(after);
      });

      jQuery('.anis-actions', this.anis).append(btn);

    };

  } else {

    jQuery('.anis-footbox', this.anis).remove();

  };

  if(_this.options.buttons.length === 0 && _this.options.title == null && !_this.options.autoclose) {

    if(_this.options.closeButton) {
      var close = jQuery('<span class="anis-closebtn"></span>');
      close.bind('click', function() {
        _this.hide();
      });

      jQuery('.anis-content', this.anis).prepend(close);

    };

  };

  _this.modal = (_this.options.modal) ? jQuery('<div class="anis-modal"></div>').css({opacity: _this.options.modalOpacity, width: jQuery(document).width(), height: jQuery(document).height(), 'z-index': _this.options.zIndex + jQuery('.anis').length}).appendTo(document.body) : null;

  if(_this.options.show) _this.show();

  jQuery(window).bind('resize', function(){ _this.resize(); });

  if(_this.options.autoclose != null) {
    setTimeout(function(_this) {
      _this.hide();
    }, _this.options.autoclose, this);
  };

  return _this;

};

Anis.prototype = {

  options: {
    autoclose: null,                         // autoclose message after 'x' miliseconds, i.e: 5000
    buttons: [],                             // array of buttons, i.e: [{id: 'ok', label: 'OK', val: 'OK'}]
    callback: null,                          // callback function after close message
    center: true,                            // center message on screen
    closeButton: true,                       // show close button in header title (or content if buttons array is empty).
    height: 'auto',                          // content height
    title: null,                             // message title
    titleClass: null,                        // title style: info, warning, success, error
    modal: false,                            // shows message in modal (loads background)
    modalOpacity: .2,                        // modal background opacity
    padding: '10px',                         // content padding
    show: true,                              // show message after load
    unload: true,                            // unload message after hide
    viewport: {top: '0px', left: '0px'},     // if not center message, sets X and Y position
    width: '500px',                          // message width
    zIndex: 99999                            // message z-index
  },
  template: '<div class="anis"><div class="anis-box"><div class="anis-wrapper"><div class="anis-titlebox"><span class="anis-title"></span></div><div class="anis-content"></div><div class="anis-footbox"><div class="anis-actions"></div></div></div></div></div>',
  content: '<div></div>',
  visible: false,

  setContent: function(data) {
    jQuery('.anis-content', this.anis).css({padding: this.options.padding, height: this.options.height}).empty().append(data);
  },

  viewport: function() {

    return {
      top: ((jQuery(window).height() - this.anis.height()) / 2) +  jQuery(window).scrollTop() + "px",
      left: ((jQuery(window).width() - this.anis.width()) / 2) + jQuery(window).scrollLeft() + "px"
    };

  },

  show: function() {

    if(this.visible) return;

    if(this.options.modal && this.modal != null) this.modal.show();
    this.anis.appendTo(document.body);

    if(this.options.center) this.options.viewport = this.viewport(jQuery('.anis-box', this.anis));

    this.anis.css({top: this.options.viewport.top, left: this.options.viewport.left, 'z-index': this.options.zIndex + jQuery('.anis').length}).show().animate({opacity: 1}, 300);

    this.visible = true;

  },

  hide: function(after) {

    if (!this.visible) return;
    var _this = this;

    this.anis.animate({opacity: 0}, 300, function() {
      if(_this.options.modal && _this.modal != null) _this.modal.remove();
      _this.anis.css({display: 'none'}).remove();
      _this.visible = false;
      if (after) after.call();
      if(_this.options.unload) _this.unload();
    });

    return this;

  },

  resize: function() {
    if(this.options.modal) {
      jQuery('.anis-modal').css({width: jQuery(document).width(), height: jQuery(document).height()});
    };
    if(this.options.center) {
      this.options.viewport = this.viewport(jQuery('.anis-box', this.anis));
      this.anis.css({top: this.options.viewport.top, left: this.options.viewport.left});
    };
  },

  toggle: function() {
    this[this.visible ? 'hide' : 'show']();
    return this;
  },

  unload: function() {
    if (this.visible) this.hide();
    jQuery(window).unbind('resize', function () { this.resize(); });
    this.anis.remove();
  }

};

jQuery.extend(Anis, {

  alert: function(data, callback, options) {

      var buttons = [{id: 'ok', label: 'OK', val: 'OK'}];

      options = jQuery.extend({closeButton: false, buttons: buttons, callback:function() {}}, options || {}, {show: true, unload: true, callback: callback});

      return new Anis(data, options);

  },

  ask: function(data, callback, options) {

    var buttons = [
      {id: 'yes', label: 'Yes', val: 'Y', "class": 'btn-success'},
      {id: 'no', label: 'No', val: 'N', "class": 'btn-danger'}
    ];

    options = jQuery.extend({closeButton: false, modal: true, buttons: buttons, callback:function() {}}, options || {}, {show: true, unload: true, callback: callback});

    return new Anis(data, options);

  },

  img: function(src, options) {

    var img = new Image();

    jQuery(img).load(function() {

      var vp = {width: jQuery(window).width() - 50, height: jQuery(window).height() - 50};
      var ratio = (this.width > vp.width || this.height > vp.height) ? Math.min(vp.width / this.width, vp.height / this.height) : 1;

      jQuery(img).css({width: this.width * ratio, height: this.height * ratio});

      options = jQuery.extend(options || {}, {show: true, unload: true, closeButton: true, width: this.width * ratio, height: this.height * ratio, padding: 0});
      new Anis(img, options);

    }).error(function() {

      console.log('Error loading ' + src);

    }).attr('src', src);

  },

  load: function(url, options) {

    options = jQuery.extend(options || {}, {show: true, unload: true, params: {}});

    var request = {
      url: url,
      data: options.params,
      dataType: 'html',
      cache: false,
      error: function (request, status, error) {
        console.log(request.responseText);
      },
      success: function(html) {
        //html = jQuery(html);
        new Anis(html, options);
      }
    };

    jQuery.ajax(request);

  }

});