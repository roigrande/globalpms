var AdPositions = {
    instances: []
};

var AdPosition = Class.create({    
    // TODO: set positions name to handle tooltips
    initialize: function(container, options) {
        // Coords for positions
        this.positions = options.positions || new Array();
        
        this.container = $(container);
        
        // HTMLElementDiv 
        this.divFrame = options.divFrame || this.container.select('div')[0];
        this.divFrame = $(this.divFrame);
        
        // Positions
        this.radios = options.radios || $$('input[name=type_advertisement]');
        
        // Binding click event to input radio
        this.initWidget();
        
        AdPositions.instances.push( this );
    },
    
    initWidget: function() {
        this.container.setStyle( {display: 'block'} );
        this.divFrame.setStyle( {display: 'none'} );
        
        this.radios.each( function(item) {
            item.observe('click', this.hdlSelectPosition.bindAsEventListener(this, item.value));
        }, this);
    },
    
    hdlSelectPosition: function(event, pos) {
        this.selectPosition(pos);
    },
    
    selectPosition: function(pos) {
        this.reset();
        
        // Banner intersticial
        if((50 + parseInt(pos))%100 == 0) {
            $('timeout_container').setStyle({display: ''});
        } else {
            $('timeout_container').setStyle({display: 'none'});
        }
        
        this.radios.each(function(item){
            if( item.value==pos ) {
                item.setAttribute('checked', 'checked');
                item.checked = true;
                
                $break;
            }
        });
        
        coords = this.positions[pos].split(',');
        this.divFrame.setStyle({
            'display': 'block',
            'opacity': 0.7,
            'left': coords[0]+'px',
            'top': coords[1]+'px',
            'width': coords[2]+'px',
            'height': coords[3]+'px'
        });
        
        new Effect.Highlight(this.divFrame, { startcolor: '#ffff99', endcolor: '#996633', restorecolor: '#996633'});
    },
    
    reset: function() {
        AdPositions.instances.each( function(refObj) {
            refObj.divFrame.setStyle({'display': 'none'});
        });
    }
});