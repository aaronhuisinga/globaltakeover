<script>
//________________________DECK______________________________________
var tPos=100;

var deck={
//base deck before shuffle
	baseDeck: [
		'd02','d03','d04','d05','d06','d07','d08','d09','d10','d11','d12','d13','d14',
		'h02','h03','h04','h05','h06','h07','h08','h09','h10','h11','h12','h13','h14',
		'c02','c03','c04','c05','c06','c07','c08','c09','c10','c11','c12','c13','c14',
		's02','s03','s04','s05','s06','s07','s08','s09','s10','s11','s12','s13','s14'
	],
	
//shuffled decks 	
	shoe :[],

//function get the decks number and return the shoe 
	shuffleDeck: function() {
		this.shoe =this.baseDeck;
		for(i=0; i<this.shoe.length; i++){
			var randomPlace=Math.floor(Math.random()*50)+1;
			var currentPlace=this.shoe[i];
			this.shoe[i]=this.shoe[randomPlace];
			this.shoe[randomPlace]=currentPlace
		}
	}
	
}

//________________________dealer___________________________
var dealer={

//function receive requested card number and return values
	getCard: function(curHand,num) {
		var q=curHand.push(deck.shoe.shift());
		if (deck.shoe.length == 0) deck.shuffleDeck();
		this.checkValue(curHand);
		showCards(curHand, q, num)
	},
	
//after all players get their cards dealer should get card eather
	play: function() {
		$('#hit').hide();
		$('#stay').hide();
		while(this.hand['value']<17){this.getCard(this.hand)}
			if(this.hand['value']>21 || this.hand['value']<player.hand['value']) {
				return 'win'
			} else if (this.hand['value'] == player.hand['value']) {
				return 'push'	
			} else {
				return false;
			}
	},

//all dealer cards	
	hand: [],
	
	checkValue: function (hand) {
		var handValue = 0;
		var acePos=0;
		for(card in hand){
			if (card == 'value' || card == 'name') continue;
			var cardNum = parseInt(hand[card].slice(1), 10);
			if(cardNum <= 10){handValue += cardNum}
				else if(cardNum < 14){handValue += 10}
					else {acePos++}
		}
		if(acePos>0){
			for(var i=1; i<=acePos; i++){
				if((handValue+11)>21){handValue+=1}
					else handValue+=11;
			}
		}
		hand['value']=handValue
	}
}

//_________________________PLAYER____________________________
var player={
	hit: function() {
		dealer.getCard(this.hand,1);
		if(this.hand['value']<=21) {return false} else return true
	},
	splitCards: function() {
	
	},
	hand: [],
	money : <?php echo $money; ?>,
	bet : 0,
	minbet:<?php echo $bjt['Mn_bd']; ?>,
	maxbet:<?php echo $bjt['Mx_bd']; ?>	
}

//_________________________Main Function______________________________
$(function() {
	deck.shuffleDeck();
	imagePreload();
	$('.chip').click(function() {
		var randomPos = Math.floor(Math.random()*15);
		var ranLeft= 380- $(this).position().left + randomPos;
		var ranBot = 210 + parseInt($(this).css('marginTop')) + randomPos;
		$(this)
			.find('img')
			.first()
			.stop(true, true)
			.clone()
			.appendTo($(this))
			.css('z-index', ++tPos).animate({
				left: ranLeft,
				bottom: ranBot
			}, 500);
		if($(this).attr('amt') == 'max') {
			if(player.money > player.maxbet) {
				var temBet=player.maxbet;
			} else {
				var temBet=player.money;
			}
		} else {
			var temBet=parseInt(($(this).attr('amt')));	
		}
		player.bet+=temBet;
		player.money-=temBet;
		if(player.bet > 0) {
			$('#clear').show();
		}
		showMeMyMoney();
		$('#dealClear').show();
	});
	
	$('#clear').click(function() {
		$('#resultMessage').slideToggle('fast').html('Bet Cleared');
			player.money+=player.bet;
			player.bet=0;
			showMeMyMoney();
			setTimeout(function() {
				$('#stay, #hit, #resultMessage, #dealClear').fadeOut('fast');
				$('#gameField, .curValue').empty();
				imagePreload();
				$('.chip img:not(:first-child)').remove();
				$('.chip img:first-child').fadeIn('slow')
			}, 1000)
			return false;
	});

	$('#deal').click(function() {
		if(player.bet > (player.money+player.bet) || player.bet > player.maxbet || player.bet < player.minbet) {
			$('#resultMessage').slideToggle('fast').html('Invalid Bet');
			player.money+=player.bet;
			player.bet=0;
			showMeMyMoney();
			setTimeout(function() {
				$('#stay, #hit, #resultMessage, #dealClear').fadeOut('fast');
				$('#gameField, .curValue').empty();
				imagePreload();
				$('.chip img:not(:first-child)').remove();
				$('.chip img:first-child').fadeIn('slow')
			}, 2000)
			return false;
		}
		player.hand['name']='player';
		dealer.hand['name']='dealer';
		$('#dealClear, .chip img:first-child').hide();
		for(var i=0; i<2; i++){
			dealer.getCard(player.hand,i);
		}
		dealer.getCard(dealer.hand,0);
		hideDealer();
		$('#stay, #hit').show();
		if(player.hand['value'] == 21){
			player.money+=(player.bet*3);
			showResult('BlackJack')
		}
		$(window).bind('beforeunload', function(){
			return 'You currently have a game in progress. If you leave, you will lose the money that you bet.';
		});
		$(window).unload(function(){
			$.ajax({
		  		url: "blackjack.php",
		  		data: {'result':'YOU LOSE','amount':player.bet},
		  		type: "POST",
		  		async: false
		  	});
		});
	});
	
	$('#hit').click(function() {
		if(player.hit()) {
			dealer.getCard(dealer.hand,1);
			showResult('BUST!');
			$('#hit').hide();
			$('#stay').hide();
		};
	});
	
	$('#stay').click(function() {
		dealer.getCard(dealer.hand,1);
		if(dealer.play() == 'win') {
			player.money+=(player.bet*2);
			showResult('YOU WIN');
		} else if(dealer.play() == 'push') {
			player.money+=(player.bet);
			showResult('PUSH');
		} else showResult('YOU LOSE')
	});
	
});
	
function showCards(hand, position, num) {
	var handName = hand['name'];
	var toShow = '';
	handName == 'player' ? toShow = 405 : toShow = 20;
	$('#gameField img')
		.eq(deck.shoe.length)
		.css('z-index', ++tPos)
		.addClass(handName+num)
		.show()
		.animate({
			top: toShow,
			right: 300-(position*45)
		},{queue:true, duration : 500});
	$('.curValue.'+hand['name']).html(hand['value']);
}

function hideDealer() {
	$('.dealer1').hide();
	$('.curValue.dealer').hide();
	$('.placeholder').show();
}

function showDealer() {
	$('.dealer1').show();
	$('.curValue.dealer').show();
	$('.placeholder').hide();
}

function updateMoney(betAmt,result) {
	$.ajax({
  		url: "blackjack.php",
  		data: {'result':result,'amount':betAmt},
  		type: "POST",
  		async: false,
  		success:  function(html){
  			if(html != '') {
	  			alert(html);
  			}
  		}
  	});
}

function numberCommas(x) {
    return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
}

function showResult(message) {
	showDealer();
	$('#resultMessage').slideToggle('fast').html(message);
	updateMoney(player.bet,message);
	player.bet=0;
	showMeMyMoney();
	player.hand.length=	dealer.hand.length=0;
	$(window).unbind('beforeunload');
	setTimeout(function() {
		$('#dealClear, #stay, #hit, #resultMessage').fadeOut('fast');
		$('#gameField, .curValue').empty();
		imagePreload();
		$('.chip img:not(:first-child)').remove();
		$('.chip img:first-child').fadeIn('slow')
	}, 2000)
}
	
	function showMeMyMoney() {
		$('#bet').find('span').fadeOut('fast').html(numberCommas(player.bet)).fadeIn('fast');
		$('#money').find('span').fadeOut('fast').html(numberCommas(player.money)).fadeIn('fast')
	}

function imagePreload() {
	for(var i=0; i<deck.shoe.length; i++) {
		$('#gameField').prepend('<img class="cardM" src="images/cards/'+deck.shoe[i]+'.jpg" alt="card"/>\n')
	}
	$('#gameField').append('<img class="cardM placeholder" src="images/cards/back.jpg" alt="card" style="z-index: 113; top: 20px; right: 230px;"/>\n')
}
</script>