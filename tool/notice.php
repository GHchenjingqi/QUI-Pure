<?php if(get_option("noticeText")) { ?>
                     <style>
                         .notice-icon{display:inline-flex;justify-content: flex-start;align-items: center;font-size:20px;font-weight:600;margin-top: 4px;}
                         .notice-icon svg{width:24px;margin-right:10px}
                         .notice-text{width:800px;float:right;overflow:hidden;position:relative;height:80px}
                         .notice-text p{white-space: nowrap;margin-top:8px;margin-bottom:0;animation: 26s scrolls linear infinite normal;display: inline-block;  position: absolute;top:0}
                         @keyframes scrolls {
                            0% {   left: 0%; }
                            100% { left: -100%;  }
                        }
                        .notice-text p span{width:100%;display:inline-block}
                        @media screen and (max-width:768px) {
                            .notice-icon{display:flex;}
                            .notice-text {  width:100%;float:none;height:30px}
                        }
                     </style>
                     <div class="notice p20 br10 mb20 bgff">
                         <div class="notice-icon">
                             <svg t="1657940060877" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2294" width="32" height="32"><path d="M921.6 880.64h-819.2A51.2 51.2 0 0 1 51.2 829.44v-66.56A107.7248 107.7248 0 0 1 158.72 655.36a30.72 30.72 0 0 0 30.72-30.72V376.832A319.6928 319.6928 0 0 1 399.36 78.2336a112.0256 112.0256 0 0 1 213.6064 0A319.6928 319.6928 0 0 1 824.32 376.832v247.808a30.72 30.72 0 0 0 30.72 30.72h10.24A107.7248 107.7248 0 0 1 972.8 762.88v66.56a51.2 51.2 0 0 1-51.2 51.2zM112.64 819.2h798.72v-56.32A46.08 46.08 0 0 0 865.28 716.8h-10.24a92.16 92.16 0 0 1-92.16-92.16V376.832a257.8432 257.8432 0 0 0-184.32-245.76l-19.0464-5.7344-2.6624-20.48a50.7904 50.7904 0 0 0-100.7616 0l-2.6624 20.48-19.0464 5.7344a257.8432 257.8432 0 0 0-184.32 245.76v247.808A92.16 92.16 0 0 1 158.72 716.8 46.08 46.08 0 0 0 112.64 762.88z" fill="#333333" p-id="2295"></path><path d="M665.6 353.6896a30.72 30.72 0 0 1-25.6-13.9264A259.4816 259.4816 0 0 0 542.72 251.904a30.72 30.72 0 0 1 28.2624-54.4768 320.9216 320.9216 0 0 1 120.6272 108.7488A30.72 30.72 0 0 1 665.6 353.6896z" fill="#3399FF" p-id="2296"></path><path d="M512 1024a174.2848 174.2848 0 0 1-174.08-174.08h61.44a112.64 112.64 0 0 0 225.28 0h61.44a174.2848 174.2848 0 0 1-174.08 174.08z" fill="#333333" p-id="2297"></path></svg>
                             <span>通知公告</span>
                         </div>
                         <div class="notice-text">
                             <p><?php echo get_option("noticeText"); ?><span></span> </p>
                         </div>
                     </div>
<?php  } ?>