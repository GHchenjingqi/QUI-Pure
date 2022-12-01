<style>
.lantern-left{position: fixed;width: 250px;height: 200px;left: -40px;top:120px;z-index:66; pointer-events:none;}
.lantern-right{position: fixed;width: 250px;height: 200px;right: 0; top:120px;pointer-events:none;}
.lantern-box{position:absolute;top:-40px;right:-20px;z-index:9999;}
.lantern-box1{position:absolute;top:-30px;right:30px;z-index:9999;}
.lantern-box1 .lantern{position:relative;width:120px;height:90px;margin:50px;background:#d8000f;background:rgba(216,0,15,0.8);border-radius:50% 50%;-webkit-transform-origin:50% -100px;-webkit-animation:swing 5s infinite ease-in-out;}
.lantern{position:relative;width:120px;height:90px;margin:50px;background:#d8000f;background:rgba(216,0,15,0.8);border-radius:50% 50%;-webkit-transform-origin:50% -100px;-webkit-animation:swing 3s infinite ease-in-out;}
.lantern-a{width:100px;height:90px;background:#d8000f;background:rgba(216,0,15,0.1);margin:12px 8px 8px 10px;border-radius:50% 50%;border:2px solid #dc8f03}
.lantern-b{width:45px;height:90px;background:#d8000f;background:rgba(216,0,15,0.1);margin:-2px 8px 8px 26px;border-radius:50% 50%;border:2px solid #dc8f03}
.line{position:absolute;top:-60px;left:60px;width:2px;height:60px;background:#dc8f03}
.shui-a{position:relative;width:5px;height:20px;margin:-5px 0 0 59px;-webkit-animation:swing 4s infinite ease-in-out;-webkit-transform-origin:50% -45px;background:#ffa500;border-radius:0 0 5px 5px}	
.shui-b{position:absolute;top:14px;left:-2px;width:10px;height:10px;background:#dc8f03;border-radius:50%}
.shui-c{position:absolute;top:18px;left:-2px;width:10px;height:35px;background:#ffa500;border-radius:0 0 0 5px}
.lantern:before{position:absolute;top:-7px;left:29px;height:12px;width:60px;content:" ";display:block;z-index:999;border-radius:5px 5px 0 0;border:solid 1px #dc8f03;background:#ffa500;background:linear-gradient(to right,#dc8f03,#ffa500,#dc8f03,#ffa500,#dc8f03)}
.lantern:after{position:absolute;bottom:-7px;left:10px;height:12px;width:60px;content:" ";display:block;margin-left:20px;border-radius:0 0 5px 5px;border:solid 1px #dc8f03;background:#ffa500;background:linear-gradient(to right,#dc8f03,#ffa500,#dc8f03,#ffa500,#dc8f03)}
.lantern-t{font-family:华文行楷,Arial,Lucida Grande,Tahoma,sans-serif;font-size:3.2rem;color:#ffe005;line-height:85px;text-align:center}
@-moz-keyframes swing{0%{-moz-transform:rotate(-10deg)}
50%{-moz-transform:rotate(10deg)}
100%{-moz-transform:rotate(-10deg)}
}@-webkit-keyframes swing{0%{-webkit-transform:rotate(-10deg)}
50%{-webkit-transform:rotate(10deg)}
100%{-webkit-transform:rotate(-10deg)}
}	
</style>
<div class="lantern-left">
		<div class="lantern-box">
			<div class="lantern">
				<div class="line"></div>
				<div class="lantern-a">
					<div class="lantern-b"><div class="lantern-t">年</div></div>
				</div>
				<div class="shui shui-a"><div class="shui-c"></div><div class="shui-b"></div></div>
			</div>
		</div>
		<div class="lantern-box1">
			<div class="lantern">
				<div class="line"></div>
				<div class="lantern-a">
					<div class="lantern-b"><div class="lantern-t">虎</div></div>
				</div>
				<div class="shui shui-a"><div class="shui-c"></div><div class="shui-b"></div></div>
			</div>
		</div>
	</div>
	<div class="lantern-right">
		<div class="lantern-box">
			<div class="lantern">
				<div class="line"></div>
				<div class="lantern-a">
					<div class="lantern-b"><div class="lantern-t">乐</div></div>
				</div>
				<div class="shui shui-a"><div class="shui-c"></div><div class="shui-b"></div></div>
			</div>
		</div>
		<div class="lantern-box1">
			<div class="lantern">
				<div class="line"></div>
				<div class="lantern-a">
					<div class="lantern-b"><div class="lantern-t">快</div></div>
				</div>
				<div class="shui shui-a"><div class="shui-c"></div><div class="shui-b"></div></div>
			</div>
		</div>
	</div>