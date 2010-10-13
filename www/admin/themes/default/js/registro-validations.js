/* Validaciones para el registro de plan conecta */

Validation.add('validate-min-length', 'Tu nick tiene que tener un mínimo de 6 caracteres.', {
    minLength: 6
});

Validation.add('validate-password', 'Tu contraseña tiene que tener un mínimo de 6 caracteres y no puede ser igual que tu nick.', {
    minLength: 6,
    notEqualToField: 'nickDA'
});

Validation.add('validate-password-notnick', 'Tu contraseña tiene que tener un mínimo de 6 caracteres.', {
    minLength: 6
});

Validation.add('revalidate-password', 'Las contraseñas no son iguales.', {
    equalToField: 'passDA'
});

Validation.add('validate-phone', 'Este campo debe ser un número de teléfono válido.', function(v) {
    /* pattern : new RegExp("^[0-9]{3}\-[0-9]{3}\-[0-9]{3}$","gi") */
    var reg_exp = new RegExp("^[\+\-\.0-9 ]+$", "gi");
    
    return Validation.get('IsEmpty').test(v) || reg_exp.test(v) ;
});

Validation.add('validate-dni', 'Este campo debe ser un DNI válido.', function(v) {                
    var reg_exp = new RegExp("^[0-9]{2}[\.][0-9]{3}[\.][0-9]{3}[\-][TRWAGMYFPDXBNJZSQVHLCKET]$","gi");
    
    if( !reg_exp.test(v) ) {
        return Validation.get('IsEmpty').test(v);
    } 
    
    v = v.replace(/[\.\-]/g, '');    
    
    var abc = v;
    var dni = abc.substring(0, abc.length-1);
    var letr = abc.charAt(abc.length - 1);
    
    if (!isNaN(letr)){            
        return false;
    }else{
        cadena="TRWAGMYFPDXBNJZSQVHLCKET";
        posicion = dni % 23;
        letra = cadena.substring(posicion,posicion+1);
        if (letra != letr.toUpperCase()){
            return false;
        }
    }
    
    return true;
});    

Validation.add('check-nick', 'El nick ya existe, introduzca otro', function(v) {
    var returnValue = false;
    
    new Ajax.Request('pc_user.php', {
      method: 'post',
      asynchronous: false,
      parameters: 'action=existsNick&category_name=conecta&nickDA=' + encodeURI(v),
      onSuccess: function(transport) {
        // transport.responseText
        //eval('response = ' + transport.responseText + ';');
        response = transport.responseJSON;
        
        returnValue = (response.exists == 0);
      }
    });
    
    return (returnValue);
});

Validation.add('check-email', 'El email ya existe en el sistema, introduzca otro', function(v) {
    var returnValue = false;
    
    new Ajax.Request('pc_user.php', {
      method: 'post',
      asynchronous: false,
      parameters: 'action=existsEmail&category_name=conecta&emailDA=' + encodeURI(v),
      onSuccess: function(transport) {
        // transport.responseText
        //eval('response = ' + transport.responseText + ';');
        response = transport.responseJSON;
        
        returnValue = (response.exists == 0);
      }
    });
    
    return (returnValue);
});