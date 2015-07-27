<div class="container">
    <header>
        <div class="row lilita tagLn">
            <div class="col-md-12 text-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fnIcn1.png"/>Get more votes, get more likes</div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="col-md-12" style=" color:#fff;">

                    <div class="row topVdesHdr topVdesHdrDtdln lilita">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">Gallery<span class="SmlTxt">(<span id="selectcategory"><?php echo $selectedcategory; ?></span>&nbsp;&nbsp;<span id="categorycount"><?php echo $totalvideos; ?></span>)</span></div>
                                <div class="col-md-3">
                                    <select class="GlrySlct categoryOptionBox" id="selectboxCategory" >
                                        <option>All</option>
                                        <option>Humour</option>
                                        <option>Action</option>
                                        <option>Songs</option>
                                        <option>Drama</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-right pull-right topVdescnt">
                            <input type="text" class="GlrySlct GlrySInpct searchVideos" placeholder="Search Videos"/></div>
                    </div>

                    <div class="row glryCntr" id="dynamic-content-gallery">
                        <?php
                        echo CHtml::hiddenField('galleryCnt', '1',
                            array('id' => 'galleryCnt'));
                        ?>
                        <?php
                        $this->renderPartial('_partialGalleryVideos',
                            array('galleries' => $galleries));
                        ?>


                    </div>
                    <?php if ($loader) { ?>
                        <div class="glryBtn glryLoad lilita" id="loadmorevideos">Load More</div>
                    <?php } ?>
                </div>
                <span class="lilita clr1 fntsz25">#Bnatural #Dubfest</span>
            </div>

        </div>
</div>
<script>

    $(document).ready(function() {

        $(".univrslPoupClose").click(function() {
            $(".UnivrslPoupup").addClass("hide");
        });

        $(".vdoethmb").click(function() {
            var videoId = $(this).parent().parent().attr('data-media-id');
            var totalVoteCnt = $(this).parent().parent().attr('data-media-vote-count');
            var mediaUrl=$(this).find(".img-responsive").attr("data-media-url");
             mediaUrl=mediaUrl.replace("watch?v=", "v/");
            $("#YourIFrameID").attr('src',mediaUrl+"&output=embed");
            $(".votNowFrm").find(".votenow").attr("data-video-id", videoId);
            $(".votNowFrm").find(".totalVoteCount").html('<span>' + totalVoteCnt + '</span>');
            $(".votNowFrm").find(".votingMessage").addClass("hide");
            $(".UnivrslPoupup").removeClass("hide");
            $(".videoSctn").removeClass("hide");
            $(".cntct").addClass("hide");
        });

        $(".PlayIcn2").click(function() {
            var videoId = $(this).parent().parent().attr('data-media-id');
            var totalVoteCnt = $(this).parent().parent().attr('data-media-vote-count');
            var mediaUrl=$(this).parent().find(".img-responsive").attr("data-media-url");
            mediaUrl=mediaUrl.replace("watch?v=", "v/");
            $("#YourIFrameID").attr('src',mediaUrl+"&output=embed");
            $(".votNowFrm").find(".votenow").attr("data-video-id", videoId);
            $(".votNowFrm").find(".totalVoteCount").html('<span>' + totalVoteCnt + '</span>');
            $(".votNowFrm").find(".votingMessage").addClass("hide");
            $(".UnivrslPoupup").removeClass("hide");
            $(".videoSctn").removeClass("hide");
            $(".cntct").addClass("hide");
        });

        $("#contact").click(function() {
            $(".UnivrslPoupup").removeClass("hide");
            $(".videoSctn").addClass("hide");
            $(".cntct").removeClass("hide");
        });

        $(".searchVideos").on("click", function() {
            var title = $(this).val();
            var categoryFilter = $("#selectboxCategory").val();
            var sortingFilter = $("#gallerySort").val();
            var param = {'title': title, 'category': categoryFilter, sort: sortingFilter};

            var objGallery = new gallerySearch(param);
            objGallery.Search();
        });

        $("#loadmorevideos").on("click", function() {
            var title = $(this).val();
            var categoryFilter = $("#selectboxCategory").val();
            var sortingFilter = $("#gallerySort").val();
            var offset = $("#galleryCnt").val();
            var loaderTrack = parseInt(offset) + 1;
            $("#galleryCnt").val(loaderTrack);
            var param = {'title': title, 'category': categoryFilter, sort: sortingFilter, 'offset': loaderTrack, 'append': true};
            var objGallery = new gallerySearch(param);
            objGallery.Search();

        });




        // Iterate over each select element
        $('select').each(function(index) {

            // Cache the number of options
            var $this = $(this),
                    numberOfOptions = $(this).children('option').length;

            // Hides the select element
            $this.addClass('s-hidden');

            // Wrap the select element in a div
            $this.wrap('<div class="select" id="select-' + index + '"></div>');

            // Insert a styled div to sit over the top of the hidden select element
            $this.after('<div class="styledSelect"></div>');

            // Cache the styled div
            var $styledSelect = $this.next('div.styledSelect');

            // Show the first select option in the styled div
            $styledSelect.text($this.children('option').eq(0).text());

            // Insert an unordered list after the styled div and also cache the list
            var $list = $('<ul />', {
                'class': 'options'
            }).insertAfter($styledSelect);

            // Insert a list item into the unordered list for each select option
            for (var i = 0; i < numberOfOptions; i++) {
                $('<li />', {
                    text: $this.children('option').eq(i).text(),
                    rel: $this.children('option').eq(i).val()
                }).appendTo($list);
            }

            // Cache the list items
            var $listItems = $list.children('li');

            // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
            $styledSelect.click(function(e) {
                e.stopPropagation();
                $('div.styledSelect.active').each(function() {
                    $(this).removeClass('active').next('ul.options').hide();
                });
                $(this).toggleClass('active').next('ul.options').toggle();
            });

            // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
            // Updates the select element to have the value of the equivalent option
            $listItems.click(function(e) {

                e.stopPropagation();
                $styledSelect.text($(this).text()).removeClass('active');
                $this.val($(this).attr('rel'));
                $list.hide();
                var param = null;
                if ($(this).parent().parent().attr('id') == "select-1") {
                    var categoryFilter = $("#selectboxCategory").val();
                    var sortingFilter = $this.val();
                    var title = $(".searchVideos").val();
                    param = {'category': categoryFilter, 'sort': sortingFilter, 'title': title};

                } else {
                    var sortingFilter = $("#gallerySort").val();
                    var title = $(".searchVideos").val();
                    param = {'title': title, 'category': $this.val(), sort: sortingFilter};

                }
                var objGallery = new gallerySearch(param);
                objGallery.Search();

            });

            // Hides the unordered list when clicking outside of it
            $(document).click(function() {
                $styledSelect.removeClass('active');
                $list.hide();
            });



        });



        /**
         *
         * @param {String} option
         * @returns {HTML}
         */
        var gallerySearch = function(param) {
            this.param = param;

            var selector = "#dynamic-content-gallery";
            var Url = {
                searchByCategory: '<?php echo Yii::app()->createUrl("/gallery/index"); ?>',
            };


            /**
             *
             * @param {String} category
             * @returns {String}
             */
            this.Search = function() {
                var queryString = {param: this.param, isAjaxRequest: 1};
                var actionUrl = Url.searchByCategory;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: actionUrl,
                    data: queryString,
                    success: function(data) {
                        (typeof param.append === "undefined") ? $(selector).html(data.template) : $(selector).append(data.template);
                        data.loader === 0 ? $("#loadmorevideos").addClass("hide") : $("#loadmorevideos").removeClass("hide");
                        $("#categorycount").html(data.totalvideos);
                        $("#selectcategory").html(data.selectedcategory);

                    }, error: function(request, status, error) {
                        console.log(request.responseText)
                        // alert(request.responseText);
                    }
                });

            }



        }
    });

</script>

