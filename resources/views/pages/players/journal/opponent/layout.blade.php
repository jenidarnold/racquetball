@extends('pages.players.layout')

@section('style')
	@parent	
	<style type="text/css">
	.starrr{
		color: green;
		font-size: 14pt;
	}

	.eval-header{
		color:white;
		font-weight: 500;
		font-size: 14pt;
		width:450px;
        padding-left: 10px !important; 
	}
	.eval-category{
		font-weight: 700;
		font-size: 12pt;
        padding-left: 10px !important; 
	}
	.eval-subcategory{
		font-weight: 500;
		font-size: 10pt;
		vertical-align: center;
         padding-left: 20px !important; 
	}
	.eval-comment {
		width: 400px;
	}

    .form-label{
        font-weight:800;
        font-size: 12pt;
    }

    .eval-title{
        font-weight:700;
        font-size: 16pt;
    }
	</style>
@stop

@section('menu')
	<div class="col-md-12">			
   		<ul class="nav nav-pills">				
			<li id="li-List"><a href="/players/{{ $player->player_id}}/journal/1/opponent">Home</a></li>
			<li id="li-New"><a href="/players/{{ $player->player_id}}/journal/{{$entry}}/opponent/create">New</a></li>
		</ul>
	</div>	
@stop

@section('player-content')
<div class="row">
			
	<div class="col-md-10">
		@yield('opponent-content')
	</div>
	</div>		
</div>	
<div class="row">
	@yield('player-footer')
</div>
@stop

@section('script')
@section('script')
<script src="{{ asset('/js/datepicker.js') }}"></script>
<script type="text/javascript">
$('.date-picker').datepicker();

// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {
                var score_id = e.target.id.replace("stars","score");

                 $("[name=" + score_id +"]").val(value);
            }
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'i', function(e) {
                return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'i', function(e) {
                return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                }
            }
            if (!rating) {
                return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $(["id^=star"]).on('starrr:change', function(e, value){
    $(["name^=score"]).html(value);
  });
  
 // $(["id^=stars"]).on('starrr:change', function(e, value){
 //   $('#currscore').html(value);
 // });
});
</script>
@stop