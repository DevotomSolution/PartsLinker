function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}

$(document).ready(function() {
	const sidenav = document.getElementById("sidenav");
	
	if (sidenav === null) {
		return;
	}
	
	const sidenavInstance = mdb.Sidenav.getInstance(sidenav);

	let innerWidth = null;

	const setMode = (e) => {
	  // Check necessary for Android devices
	  if (window.innerWidth === innerWidth) {
		return;
	  }

	  innerWidth = window.innerWidth;

	  if (window.innerWidth < 1400) {
		sidenavInstance.changeMode("over");
		sidenavInstance.hide();
	  } else {
		sidenavInstance.changeMode("side");
		sidenavInstance.show();
	  }
	};

	setMode();
	
	// Event listeners
	window.addEventListener("resize", setMode);
	
	$('button[type=\'submit\']').on('click', function() {
	  loading();
	  
	  /*setTimeout(function() {
		loading(false);
	  }, 5000);*/
	});
});

$(document).ready(function() {
	//Form Submit for IE Browser
	//$('button[type=\'submit\']').on('click', function() {
		//$("form[id*='form-']").submit();
	//});

	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();

		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});

	// tooltips on hover
	$('[data-mdb-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-mdb-toggle=\'tooltip\']').tooltip({container: 'body'});
	});

	// https://github.com/opencart/opencart/issues/2595
	$.event.special.remove = {
		remove: function(o) {
			if (o.handler) {
				o.handler.apply(this, arguments);
			}
		}
	}
	
	// tooltip remove
	$('[data-mdb-toggle=\'tooltip\']').on('remove', function() {
		$(this).tooltip('destroy');
	});

	// Tooltip remove fixed
	$(document).on('click', '[data-mdb-toggle=\'tooltip\']', function(e) {
		$('body > .tooltip').remove();
	});
	
	$('#button-menu').on('click', function(e) {
		e.preventDefault();
		
		$('#column-left').toggleClass('active');
	});

	// Set last page opened on the menu
	$('#menu a[href]').on('click', function() {
		sessionStorage.setItem('menu', $(this).attr('href'));
	});

	if (!sessionStorage.getItem('menu')) {
		$('#menu #dashboard').addClass('active');
	} else {
		// Sets active and open to selected page in the left column menu.
		$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parent().addClass('active');
	}
	
	$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li > a').removeClass('collapsed');
	
	$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('ul').addClass('in');
	
	$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active');
});

// Voice Search
(function($) {
	$.fn.addVoiceTrigger = function(callback) {
		let SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
	
		if(!SpeechRecognition) {
			return;
		}
		
		let listening = false;
		let popover;
		
		let recognition = new SpeechRecognition();
		recognition.interimResults = true;
		
		recognition.onresult = function(e) {
			if(e.results[0].isFinal) {
				callback(e.results[0][0].transcript);
			}
		}
		
		recognition.onend = function() {
			trigger.classList.add('text-body');
			trigger.classList.remove('text-primary');
			listening = false;
			popover.dispose();
		}
		
		let trigger = document.createElement('div');
		trigger.innerHTML = '<i class="fas fa-microphone"></i>';
		trigger.classList.add('fs-5');
		trigger.classList.add('text-body');
		trigger.style.position = 'absolute';
		trigger.style.top = '3px';
		trigger.style.right = '8px';
		trigger.style.cursor = 'pointer';
		
		trigger.onclick = function(e) {
			e.preventDefault();
			
			if(listening) {
				recognition.stop();
				listening = false;
			} else {
				recognition.start();
				listening = true;
				trigger.classList.add('text-primary');
				trigger.classList.remove('text-body');
				popover = new mdb.Popover(trigger, {container: 'body', trigger: 'manual', placement: 'top', content: '...'});
				popover.show();
			}
		};
		
		this[0].style.position = 'relative';
		
		this[0].append(trigger);
	}
})(window.jQuery);

//Resize image
async function imageResize(file, maxWidth, maxHeight) {
	let img = new Image;
	img.src = window.URL.createObjectURL(file);
	await img.decode();
   
	let width = img.width;
	let height = img.height;

	if (width > height) {
		if (width > maxWidth) {
			height *= maxWidth / width;
			width = maxWidth;
		}
	} else {
		if (height > maxHeight) {
			width *= maxHeight / height;
			height = maxHeight;
		}
	}
	
	let canvas = document.createElement('canvas');

	canvas.width = width;
	canvas.height = height;
	
	let ctx = canvas.getContext("2d");
	ctx.drawImage(img, 0, 0, width, height);
  
	let blob = await new Promise(resolve => canvas.toBlob(resolve, 'image/jpeg', 0.95));
  
	return new File([blob], 'file.jpg', {type: 'image/jpeg'});
}

//Alert
function addAlert(title, msg, color = 'success', delay = 0) {
	const alert = document.createElement('div');
	
	alert.innerHTML = '<p class="alert-heading d-flex"><strong class="flex-fill">'+title+'</strong><button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button></p><hr/><p class="mb-0">'+msg+'</p>';
	alert.classList.add('alert', 'fade');
	alert.style.maxWidth = '80%';
  
	document.body.appendChild(alert);
	
	const alertInstance = new mdb.Alert(alert, {
		color,
		stacking: true,
		hidden: true,
		width: '450px',
		position: 'bottom-right',
		autohide: delay > 0 ? true : false,
		delay: delay,
	});

	alertInstance.show();
}

//Loading
function loading(status = true) {
	$('#loading').remove();
	
	if(status) {
		let spinner = document.createElement('div');
		spinner.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
		spinner.classList.add('bg-dark', 'w-100', 'h-100', 'position-fixed', 'bg-opacity-25', 'd-flex', 'align-items-center', 'justify-content-center');
		spinner.style.top = '0';
		spinner.style.zIndex = '100000';
		spinner.id = 'loading';
		
		document.body.appendChild(spinner);
	}
}

// Carousel
(function($) {
	$.fn.carousel2 = function(items) {
		let activeItemNumber = 0;
		let maxWidth = items.length * 160;
		
		let main = document.createElement('div');
		main.style.position = 'relative';
		main.style.overflow = 'hidden';
		main.classList.add('p-1');
		
		let list = document.createElement('div');
		list.classList.add('d-flex');
		list.style.transitionProperty = 'margin-left';
		list.style.transitionDuration = '0.2s';
		
		let html = '';
		
		for(let i = 0; i < items.length; i++) {
			html += '<div style="height: 90px; max-width: 150px; min-width: 150px; margin-left: 5px; margin-right: 5px;">';
				html += '<a class="btn btn-light shadow-1-strong bg-image hover-zoom w-100 h-100';
				
				if(items[i].active) {
					html += ' active';
					activeItemNumber = i;
				}
				
				html += '" href="'+items[i].url+'">';
				
				if(items[i].image != '') {
					html += '<img src="'+items[i].image+'" class="h-100" alt="'+items[i].title+'"/>';
				} else {
					html += items[i].title;
				}
				
				html += '</a>';
			html += '</div>';
		}
		
		list.innerHTML = html;
		
		let buttonLeft = document.createElement('button');
		buttonLeft.classList.add('btn');
		buttonLeft.classList.add('btn-primary');
		buttonLeft.classList.add('btn-floating');
		buttonLeft.classList.add('position-absolute');
		buttonLeft.innerHTML = '<i class="fas fa-angle-left"></i>';
		buttonLeft.style.top = '30px';
		buttonLeft.style.left = '0';
		
		buttonLeft.onclick = function() {
			let marginLeft = Number(list.style.marginLeft.replace('px', '')) + 320;

			if(marginLeft > 0) {
				marginLeft = 0;
			}
			
			list.style.marginLeft = marginLeft + 'px';
		}
		
		let buttonRight = document.createElement('button');
		buttonRight.classList.add('btn');
		buttonRight.classList.add('btn-primary');
		buttonRight.classList.add('btn-floating');
		buttonRight.classList.add('position-absolute');
		buttonRight.innerHTML = '<i class="fas fa-angle-right"></i>';
		buttonRight.style.top = '30px';
		buttonRight.style.right = '0';
		
		buttonRight.onclick = function() {
			let marginLeft = Number(list.style.marginLeft.replace('px', '')) - 320;

			if(marginLeft > 0) {
				marginLeft = 0;
			}
			
			if(maxWidth < main.offsetWidth) {
				return;
			}
			
			if(main.offsetWidth - marginLeft > maxWidth) {
				marginLeft = main.offsetWidth - maxWidth;
			}
			
			list.style.marginLeft = marginLeft + 'px';
		}
		
		window.onload = function() {
			if(!activeItemNumber) {
				return;
			}
			
			marginLeft = 0 - activeItemNumber * 160;
			
			if(main.offsetWidth - marginLeft > maxWidth) {
				return;
			}
			
			list.style.marginLeft = marginLeft + 'px';
		}
		
		main.appendChild(list);
		main.appendChild(buttonLeft);
		main.appendChild(buttonRight);
		
		this[0].append(main);
	}
})(window.jQuery);

function copy(copyText) {
  let el = document.createElement('textarea');
  el.value = copyText;
  el.style.position = 'absolute';
  el.style.opacity = '0';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
}