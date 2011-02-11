{extends file="public.tpl"}
    {block name="body-main" append}
        <FORM action="http://globalpms.es/public/index" method="post">
                <P>
                <LABEL for="nombre">Nombre: </LABEL>
                          <INPUT type="text" id="nombre"><BR>
                <LABEL for="apellido">Apellido: </LABEL>
                          <INPUT type="text" id="apellido"><BR>
                <LABEL for="email">email: </LABEL>
                          <INPUT type="text" id="email"><BR>
                <INPUT type="radio" name="sexo" value="Varón"> Varón<BR>
                <INPUT type="radio" name="sexo" value="Mujer"> Mujer<BR>
                <INPUT type="submit" value="Enviar"> <INPUT type="reset">
                </P>
        </FORM>
    {/block}