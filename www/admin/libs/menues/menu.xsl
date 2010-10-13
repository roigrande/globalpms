<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:output method="html" version="1.0" standalone="yes" indent="yes"/>
	<xsl:template match="/">
		<table border="0" cellpadding="2" cellspacing="3" width="100%">
			<tbody>
				<xsl:apply-templates/>
			</tbody>
		</table>
	</xsl:template>
	<xsl:template match="submenu">
		<tr>
			<td align="left" style="border:1px dotted #EAEAEA;background-color: #637F63;">
				<a href="{@enlace}" target="{@target}" style="color: #FFFFFF; padding:2px; font-size:12px;">
					<xsl:value-of select="@nombre"/>
				</a><xsl:apply-templates/>
			</td>
		</tr>
	</xsl:template>
	<xsl:template match="nodo">
		<tr>
			<td align="left" style="border:1px dotted #EAEAEA; background-color: #637F63;">
				<a href="{@enlace}" target="{@target}" style="color: #FFFFFF;">
					<xsl:value-of select="@nombre"/>
				</a>
			</td>
		</tr>
	</xsl:template>
	<xsl:template match="submenu/nodo">
		<a href="{@enlace}" target="{@target}" style="color: #FEFEFE; padding:2px; font-size:12px; border: 1px solid #999999;">
			<xsl:value-of select="@nombre"/>
		</a>
	</xsl:template>
</xsl:stylesheet>
