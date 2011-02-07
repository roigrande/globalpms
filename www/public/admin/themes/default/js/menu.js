function Menu(nm, ymin, ymax) {
	var nom = nm;
	var openMenu = '';
	var min_y = ymin; //115 
	var max_y = ymax; //165
	var interv = null;
	var moz_alfa = 0.0;
	var isMoz = (navigator.userAgent.indexOf("Gecko")!=-1)?true:false;
	var isIE = (navigator.userAgent.indexOf("MSIE")!=-1)?true:false;
	
	/* Fade-in */
	this.fadeInIE = function() {
		if(openMenu!='') {
			var ee = document.getElementById(openMenu);
			if(ee.filters.alpha.opacity == 0) { 
				ee.style.backgroundImage = 'url(images/fondo.gif)';}
			ee.filters.alpha.opacity += 10;
			//ee.filters.item("DXImageTransform.Microsoft.Alpha").opacity += 10;
			
			//if(ee.filters.item("DXImageTransform.Microsoft.Alpha").opacity >= 100) {
			if(ee.filters.alpha.opacity >= 100) {
				
				//ee.style.backgroundColor = '#637F63'; 
				clearInterval(interv);
			}				
		} else {
			clearInterval(interv);		
		}
	}
	
	this.fadeInMoz = function() {
		if(openMenu!='') {
			var ee = document.getElementById(openMenu);
	
			moz_alfa += 0.10;
			ee.style.MozOpacity = moz_alfa;		
			
			if(ee.style.MozOpacity >= 1) {		
				clearInterval(interv);
			}		
		} else {
			clearInterval(interv);		
		}
	}
	
	this.fadeOutIE = function() {
		if(openMenu!='') {
			var ee = document.getElementById(openMenu);
			ee.filters.alpha.opacity -= 20;
			
			if(ee.filters.alpha.opacity <= 0) {	
				ee.style.display = 'none';					
				clearInterval(interv);
				openMenu = '';
			}				
		} else {
			clearInterval(interv);		
		}
	}
	
	this.fadeOutMoz = function() {
		if(openMenu!='') {
			var ee = document.getElementById(openMenu);
	
			moz_alfa -= 0.20;
			ee.style.MozOpacity = moz_alfa;		
			
			if(ee.style.MozOpacity <= 0) {
				ee.style.display = 'none';					
				clearInterval(interv);		
				openMenu = '';
			}		
		} else {
			clearInterval(interv);		
		}
	}
	
	this.mostrar = function(subMenu) {
		if(subMenu != openMenu) {
			// Ocultar el submenú anterior
			this.ocultar();
			
			try {
				// Mostrar el submenu actual
				var elto = document.getElementById(subMenu);
				elto.style.display = 'inline';
				openMenu = subMenu;
						
				if (isMoz) {
					interv = setInterval(nom + ".fadeInMoz()", 100);
				} else {
					if(isIE) {			
						interv = setInterval(nom + ".fadeInIE()", 100);
					}
				}
			} catch(e) {}
		}
	}
		
	this.ocultar = function() {
		if(openMenu != '') {
			var elto = document.getElementById(openMenu);	
			clearInterval(interv);	
	
			if (isMoz) {
				elto.style.MozOpacity = 0.0;
				moz_alfa = 0.0;
			} else {
				if(isIE){
					elto.filters.alpha.opacity = 0;			
				}
			}
	
			elto.style.display = 'none';
			openMenu = '';
		}
	}
	
	this.closesubnav = function(evt){
		evt = (evt) ? evt : event;		
		if ((evt.clientY < min_y)||(evt.clientY > max_y)) {
				if(openMenu != '') {				
					clearInterval(interv);
					if (isMoz) {
						interv = setInterval(nom + ".fadeOutMoz()", 100);
					} else{
						if(isIE) {
							interv = setInterval(nom + ".fadeOutIE()", 100);
						} else {
							this.ocultar();
						}
					}
				}
				//ocultar();
		} //if(openmenu!='')
	}
	
	/* Cosntructor */
	document.onmousemove = this.closesubnav;
}
