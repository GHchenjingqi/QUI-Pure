$(function () {
			function bannerMove(obj) {
				var index = 0;
				var _thatFlag = true;
				var _that = $(obj.el);
				var _length = _that.find("li").length;
				var a_prev = index - 1 < 0 ? '-1' : index - 1;
				var a_next = index + 1 >= _length ? '0' : index + 1;
				var timer;
				_that.append(
					"<div class='banner-btn'><span class='banner-btn-prev'></span><span class='banner-btn-next'></span></div>");
				if (_length < 4) {
					if (_length < 2) {
						_that.find("li").eq(index).addClass("on");
						return false;
					} else {
						for (let i = 0; i < (4 - _length); i++) {
							var tempHtml = _that.find("li").eq(i).html()
							_that.find("ul").append('<li>' + tempHtml + '</li>')
						}
					}
				}
				_that.find("li").css({
					"left": "-1400px",
					"z-index": "1"
				});
				_that.find("li").eq(index - 1).css({
					"left": "-400px",
					"z-index": "2"
				});
				_that.find("li").eq(index).css({
					"left": "0px",
					"z-index": "3"
				});
				_that.find("li").eq(index + 1).css({
					"left": "400px",
					"z-index": "2"
				});
				_that.find("li").eq(index).addClass("on");

				_that.on("click", ".banner-btn-prev", function () {
					if (_thatFlag) {
						_thatFlag = false;
						main(1);
					}
				})
				_that.on("click", ".banner-btn-next", function () {
					if (_thatFlag) {
						_thatFlag = false;
						main(0);
					}
				});
				clearInterval(timer);
				timer = setInterval(function () {
					main(0);
				}, 5000);
				_that.hover(function () {
					clearInterval(timer);
				}, function () {
					clearInterval(timer);
					timer = setInterval(function () {
						main(0);
					}, 5000);
				})
				function main(fx) {
					if (fx) {
						// console.log("左")
						if (index > _length - 1) index = 0;
						a_prev = index - 1 < 0 ? '-1' : index - 1;
						a_next = index + 1 >= _length ? '0' : index + 1;
						_that.find("li").eq(-1).prependTo(_that.find("li").parent());
						_that.find("li").eq(a_prev).css({
							"left": "-800px",
							"z-index": "1"
						}).animate({
							"left": "-400px",
							"z-index": "1"
						});
						_that.find("li").eq(index).css({
							"left": "-400px",
							"z-index": "3"
						}).animate({
							"left": "0px",
							"z-index": "3"
						});
						_that.find("li").eq(a_next).css({
							"left": "0px",
							"z-index": "2"
						}).animate({
							"left": "400px",
							"z-index": "2"
						});
						_that.find("li").eq(a_next + 1).css({
							"left": "400px",
							"z-index": "1"
						}).animate({
							"left": "800px",
							"z-index": "0"
						}, function () {
							_thatFlag = true;
						});
						_that.find("li").eq(0).addClass("on").siblings().removeClass("on");
					} else {
						// console.log("右")
						if (index > _length - 1) index = 0;
						a_prev = index - 1 < 0 ? '-1' : index - 1;
						a_next = index + 1 >= _length ? '0' : index + 1;
						_that.find("li").eq(a_prev).css({
							"left": "-400px",
							"z-index": "1"
						}).animate({
							"left": "-800px",
							"z-index": "1"
						});
						_that.find("li").eq(index).css({
							"left": "0px",
							"z-index": "2"
						}).animate({
							"left": "-400px",
							"z-index": "2"
						});
						_that.find("li").eq(a_next).css({
							"left": "400px",
							"z-index": "3"
						}).animate({
							"left": "0px",
							"z-index": "3"
						});
						_that.find("li").eq(a_next + 1).css({
							"left": "800px",
							"z-index": "2"
						}).animate({
							"left": "400px",
							"z-index": "2"
						}, function () {
							_that.find("li").eq(0).appendTo(_that.find("li").parent());
							_thatFlag = true;
						});
						_that.find("li").eq(1).addClass("on").siblings().removeClass("on");
					}
				}
			}
			var myMove = new bannerMove({
				el: ".bannerBox .banner1"
			})
		})