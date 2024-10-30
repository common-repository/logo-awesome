<?php
    $logos = carbon_get_post_meta( get_the_ID(), 'logo_items' );
?>

<div id="style-tiga" class="body-wrap style-tiga logo-post-<?php echo esc_attr(get_the_ID()); ?>" >
    <!-- # component starts -->
    <div class="pres-logo" id="this-logo">
        <!-- ### -->
        <!--   <div class="cards-section"> -->
        <div class="cards-container">
            <?php $no = 0; foreach ( $logos as $logo ) { $no++; ?>
            <section class="card-single <?php if($no == 1) {echo 'active';} ?>" period="no_<?php echo esc_attr($no); ?>">
                <div class="content">
                    <?php echo wp_get_attachment_image( esc_html($logo['logo_item_img']), 'full' ); ?>
                </div>
            </section>
            <?php } ?>
        </div>
        <!--   </div> -->
        <!-- ###  -->
        <!--   <div class="logo-section"> -->
        <div class="style-6-container">
            <!--  # logo graphic place holder - fill with js -->
            <div class="logo"></div>
            <div class="btn-back">
                <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                <path fill="none" d="M0 0h30v30H0z" />
                <path fill="#D8D8D8" fill-rule="evenodd" d="M11.828 15l7.89-7.89-2.83-2.828L6.283 14.89l.11.11-.11.11L16.89 25.72l2.828-2.83" /></svg>
            </div>
            <div class="btn-next">
                <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                <path fill="none" d="M0 0h30v30H0z" />
                <path fill="#D8D8D8" fill-rule="evenodd" d="M18.172 14.718l-7.89-7.89L13.112 4l10.606 10.607-.11.11.11.11-10.608 10.61-2.828-2.83 7.89-7.89" /></svg>
            </div>
        </div>
        <!--   </div> -->
        <!-- ###   -->
        <!--   <div class="periods-section"> -->
        <div class="periods-container">
            <?php $no = 0; foreach ( $logos as $logo ) { $no++; ?>
            <section class="period-single" period="no_<?php echo esc_attr($no); ?>">
                <h4 class="year logo-info"><?php logo_title_view($logo['logo_item_name']); ?></h4>
                <p class="logo-text"><?php logo_bio_view($logo['logo_item_bio']); ?></p>
            </section>
            <?php } ?>
            <div class="btn-back"></div>
            <div class="btn-next"></div>
        </div>
        <!--   </div> -->
        <!-- ### -->
        
    </div>
    <!-- # component ends -->
</div>

<?php wp_enqueue_script( 'logo-awesome-stopExecution', plugin_dir_url(__DIR__ ) . 'js/stopExecution.js', array( 'jquery' ), '', false ); ?>

<script>
(function($) {
    'use strict';
    var PRESTimeline = /** @class */ function() {
        function PRESTimeline(target, color) {
            // this.__process_stylesheet(document.styleSheets[0]);
            this.base = target;
            this.color = color;
             //console.log(this.color);
            this.periodContainer = $(this.base).find('.periods-container');
            this.cardContainer = $(this.base).find('.cards-container');
            this.logoNodeContainer = $(this.base).find('.style-6-container .logo');
            this.activePeriod = $(this.base).find('.periods-container section.active')
            this._parseData();
            this._initialColor();
            this._generateTimeline();
            this._setStateClasses();
            this._assignBtn();
            this._adjustPeriodContainer();
            this._adjustCardContainer();
            // console.log(this.cardData)
        }
        PRESTimeline.prototype._parseData = function() {
            var base = this.base;
            var periods = $(base).find('.periods-container section');
            for (var _i = 0, periods_1 = periods; _i < periods_1.length; _i++) {
                if (window.CP.shouldStopExecution(0)) break;
                var section = periods_1[_i];
                section.period = $(section).attr('period');
                section.index = $(section).index();
            }
            // console.log(periods)
            window.CP.exitedLoop(0);
            this.periodData = periods;
            var data = $(base).find('.cards-container section');
            // console.log(data)
            for (var _a = 0, data_1 = data; _a < data_1.length; _a++) {
                if (window.CP.shouldStopExecution(1)) break;
                var section = data_1[_a];
                section.period = $(section).attr('period');
                section.index = $(section).index();
            }
            // console.log(data)
            window.CP.exitedLoop(1);
            this.cardData = data;
            // #assign initial entry point (active items)
            this.activePeriod = this.periodData[0];
            this.activePeriodIndex = 0;
            this.activeCard = this.cardData[0];
            this.activeCardIndex = 0;
        };
        PRESTimeline.prototype._setStateClasses = function() {
            // # periods
            $(this.base).find('.periods-container section.active').removeClass('active');
            $(this.base).find('.periods-container section.prev').removeClass('prev');
            $(this.base).find('.periods-container section.next').removeClass('next');
            // console.log("setclass: " + this.activePeriod.index)
            $(this.activePeriod).addClass('active');
            // console.log(this.activePeriod.index)
            // this.activePeriodIndex = this.activePeriod.index
            if ($(this.activePeriod).prev().length != 0) {
                $(this.activePeriod).prev().addClass('prev');
                $(this.base).find('.periods-container .btn-back').removeClass('hide');
            } else {
                $(this.base).find('.periods-container .btn-back').addClass('hide');
            }
            if ($(this.activePeriod).next().length != 0) {
                $(this.activePeriod).next().addClass('next');
                $(this.base).find('.periods-container .btn-next').removeClass('hide');
            } else {
                $(this.base).find('.periods-container .btn-next').addClass('hide');
            }
            // ## cards
            $(this.base).find('.cards-container section.active').removeClass('active');
            $(this.base).find('.cards-container section.prev').removeClass('prev');
            $(this.base).find('.cards-container section.next').removeClass('next');
            $(this.activeCard).addClass('active');
            // this.activeCardIndex - this.activeCard.index
            if ($(this.activeCard).prev().length != 0) {
                $(this.activeCard).prev().addClass('prev');
            }
            if ($(this.activeCard).next().length != 0) {
                $(this.activeCard).next().addClass('next');
            }
            // ## logo 
            $(this.base).find('.logo li.active').removeClass('active');
            // let findNode = $(this.base).find('.logo ol li')[this.activeCard.index]
            $(this.logoData[this.activeCard.index]).addClass('active');
            var logoB = $(this.base).find('.style-6-container .btn-back');
            var logoN = $(this.base).find('.style-6-container .btn-next');
            // console.log($(logoN))
            if (this.activeCardIndex === 0) {
                logoB.addClass('hide');
            } else {
                logoB.removeClass('hide');
            }
            if (this.activeCardIndex >= this.cardData.length - 1) {
                logoN.addClass('hide');
            } else {
                logoN.removeClass('hide');
            }
        };
        // ## logo generater
        PRESTimeline.prototype._generateTimeline = function() {
            // ## create node list
            var htmlWrap = '<ol></ol>';
            $(this.logoNodeContainer).append(htmlWrap);
            var wrap = $(this.logoNodeContainer).find('ol');
            var numNode = this.cardData.length;
            for (var i = 0; i < numNode; i++) {
                if (window.CP.shouldStopExecution(2)) break;
                var c = this.cardData[i].color;
                var el = wrap.append('<li class="' + this.cardData[i].period + '" style="border-color: ' + c + '"></li>');
            }
            // ## width of logo
            window.CP.exitedLoop(2);
            var nodeW = 200;
            wrap.css('width', nodeW * numNode - 16);
            var nodeList = $(this.base).find('.logo ol li');
            this.logoData = nodeList;
        };
        // ## assign button actions
        PRESTimeline.prototype._assignBtn = function() {
            var _this = this;
            var periodPrev = $(this.base).find('.periods-container .btn-back');
            var periodNext = $(this.base).find('.periods-container .btn-next');
            periodPrev.click(function() {
                if (_this.activePeriodIndex > 0) {
                    // console.log('prev')
                    _this.activePeriodIndex -= 1;
                    _this.activePeriod = _this.periodData[_this.activePeriodIndex];
                    _this._chainActions('period');
                    _this._setStateClasses();
                }
                _this._adjustPeriodContainer();
            });
            periodNext.click(function() {
                if (_this.activePeriodIndex < _this.periodData.length - 1) {
                    // console.log('next' + this.activePeriodIndex)
                    _this.activePeriodIndex += 1;
                    _this.activePeriod = _this.periodData[_this.activePeriodIndex];
                    _this._chainActions('period');
                    _this._setStateClasses();
                }
                _this._adjustPeriodContainer();
            });
            var logoPrev = $(this.base).find('.style-6-container .btn-back');
            var logoNext = $(this.base).find('.style-6-container .btn-next');
            logoPrev.click(function() {
                if (_this.activeCardIndex > 0) {
                    _this.activeCardIndex -= 1;
                    _this.activeCard = _this.cardData[_this.activeCardIndex];
                    _this._chainActions('logo');
                    _this._setStateClasses();
                }
                _this._adjustCardContainer();
                _this._adjustPeriodContainer();
            });
            logoNext.click(function() {
                if (_this.activeCardIndex < _this.cardData.length - 1) {
                    _this.activeCardIndex += 1;
                    _this.activeCard = _this.cardData[_this.activeCardIndex];
                    _this._chainActions('logo');
                    _this._setStateClasses();
                }
                _this._adjustCardContainer();
                _this._adjustPeriodContainer();
            });
            var _loop_1 = function(i) {
                $(this_1.logoData[i]).click(function() {
                    _this.activeCardIndex = _this.cardData[i].index;
                    _this.activeCard = _this.cardData[_this.activeCardIndex];
                    _this._chainActions('logo');
                    _this._setStateClasses();
                    _this._adjustCardContainer();
                    _this._shiftTimeline();
                });
            };
            var this_1 = this;
            // ## assign each logo li
            for (var i = 0; i < this.logoData.length; i++) {
                if (window.CP.shouldStopExecution(3)) break;
                _loop_1(i);
            }
            window.CP.exitedLoop(3);
        };
        // ## color ##
        PRESTimeline.prototype._initialColor = function() {
            for (var i = 0; i < this.periodData.length; i++) {
                if (window.CP.shouldStopExecution(4)) break;
                var p = this.periodData[i].period;
                this.periodData[i].color = this.color[p];
                var temp = this.periodData[i];
                $(temp).css('border-color', temp.color);
                $(temp).find('.year').css('color', temp.color);
                // ## color for logo items, this part utilize the period name as class which will be add to the li later
                // ### cross browser bug fix
                var sbstyle = document.createElement("style");
                document.head.appendChild(sbstyle);
                // let sheet = document.styleSheets[0]
                sbstyle.sheet.insertRule('li.' + p + '.active { background-color: ' + this.color[p] + ' !important } ', 0);
                sbstyle.sheet.insertRule('li.' + p + '::before { background-color: ' + this.color[p] + ' } ', 0);
                sbstyle.sheet.insertRule('li.' + p + '::after { background-color: ' + this.color[p] + ' } ', 0);
            }
            window.CP.exitedLoop(4);
            for (var i = 0; i < this.cardData.length; i++) {
                if (window.CP.shouldStopExecution(5)) break;
                var p = this.cardData[i].period;
                this.cardData[i].color = this.color[p];
                var temp = this.cardData[i];
                $(temp).css('border-color', temp.color);
                $(temp).find('.year').css('color', temp.color);
            }
            window.CP.exitedLoop(5);
        };
        PRESTimeline.prototype._adjustPeriodContainer = function() {
            var activeH = $(this.activePeriod).outerHeight();
            $(this.periodContainer).height(activeH);
            //console.log('top adjusted');
        };
        PRESTimeline.prototype._adjustCardContainer = function() {
            var activeH = $(this.activeCard).outerHeight() + 24;
            $(this.cardContainer).height(activeH);
            //console.log('bot adjusted');
        };
        PRESTimeline.prototype._shiftTimeline = function() {
            // #### We need to fix this part if using this component in different sizes ####
            var logoW = $(this.base).find('.style-6-container').outerWidth();
            var logoPadding = 210;
            var logoCenter = 300;
            var liWidth = 16;
            var activeNodeX = $(this.logoData[this.activeCardIndex]).position().left;
            var finalPos = -activeNodeX + logoPadding;
            $(this.logoNodeContainer).css('left', finalPos);
            console.log(activeNodeX);
        };
        PRESTimeline.prototype._chainActions = function(state) {
            switch (state) {
                case 'period':
                    console.log('period');
                    if (this.activePeriod.period != this.activeCard.period) {
                        // ## find the closest li with the active period
                        var ta = [];
                        for (var i = 0; i < this.cardData.length; i++) {
                            if (window.CP.shouldStopExecution(6)) break;
                            var temp = this.cardData[i];
                            if (this.activePeriod.period === temp.period)
                                ta.push(temp);
                        }
                        window.CP.exitedLoop(6);
                        this.activeCard = ta[0];
                        this.activeCardIndex = ta[0].index;
                    }
                    break;
                case 'logo':
                    console.log('logo');
                    if (this.activeCard.period != this.activePeriod.period) {
                        var ta = void 0;
                        for (var i = 0; i < this.periodData.length; i++) {
                            if (window.CP.shouldStopExecution(7)) break;
                            var temp = this.periodData[i];
                            if (this.activeCard.period === temp.period)
                                ta = temp;
                        }
                        window.CP.exitedLoop(7);
                        this.activePeriod = ta;
                        this.activePeriodIndex = ta.index;
                    }
                    break;
            }

            this._shiftTimeline();
            this._adjustCardContainer();
        };
        return PRESTimeline;
    }();
    
    // ## document load ##
    $(document).ready(function() {
        var colorcode = {
        <?php $no = 0; foreach ( $logos as $logo ) { $no++; ?>
            'date_<?php echo esc_html($logo['logo_date']); ?>': '<?php echo esc_html($logo['logo_horizontal_10_color']); ?>',
        <?php } ?>
        };

        var logo = new PRESTimeline($('#this-logo'), colorcode);
    });
})(jQuery);
</script>