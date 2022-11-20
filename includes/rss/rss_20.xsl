<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:dc="http://purl.org/dc/elements/1.1/" version="1.0">
<xsl:output method="html" />
<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<script>
function decodeEscaped()
{
  if(document.getElementsByName)
  {
    var escaped=document.getElementsByName('escaped')

    for(e = 0; e&lt;escaped.length; e++)
      escaped[e].innerHTML= escaped[e].innerHTML.replace(/&amp;lt;/g, '&lt;').replace(/&amp;gt;/g, '&gt;').replace(/&amp;amp;/g, '&amp;').replace(/&amp;quot;/g, '&quot;')
  }
}
</script>
<head>
<title><xsl:value-of select="rss/channel/title"/></title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<style>
div.channel-title { font-family: sans-serif, arial, helvetica }
div.image { font-family: sans-serif, arial, helvetica }
div.image-description { font-family: sans-serif, arial, helvetica }
div.item-title { font-family: sans-serif, arial, helvetica }
div.item-description { font-family: sans-serif, arial, helvetica }
div.textinput-title { font-family: sans-serif, arial, helvetica }
div.textinput-form { font-family: sans-serif, arial, helvetica }

#ItemList {
  list-style-type: circle;
  color: #666666;
}

.ItemListItem {
  padding-bottom: 8px;
}

.ItemListItemDetails {
  font-family: Arial, Helvetica;
  font-size: 8pt;
  color: #333333;
}
h1,h2,h4 {
  color: #666666;
  font-weight: bold;
  font-family: Arial, Arial, Helvetica;
  margin: 0px;
  font-size: 25pt;
}

h2 {
  font-size: 16pt;
  margin-left: 16px;
}

h4 {
  font-size: 14pt;
  font-family: Arial, Helvetica;
}
</style>
</head>
<body onload="decodeEscaped()">

<xsl:for-each select="rss/channel/image">
<center><div class="image">
<xsl:element name="a">
  <xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
  <xsl:element name="img">
    <xsl:attribute name="src"><xsl:value-of select="url"/></xsl:attribute>

    <xsl:attribute name="alt"><xsl:value-of select="title"/></xsl:attribute>
    <xsl:attribute name="border">0</xsl:attribute>
  </xsl:element>
</xsl:element>
</div></center>
<center><div class="image-description">
<xsl:value-of select="description"/>
</div></center>
</xsl:for-each>

<xsl:for-each select="rss/channel">
<center><div class="channel-title">
<xsl:element name="a">

  <xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
  <h4><xsl:value-of select="title"/></h4>
  <xsl:value-of select="pubDate"/>
</xsl:element>
</div></center>
</xsl:for-each>

<ul id="ItemList">
<hr />
<xsl:for-each select="rss/channel/item">
<div class="item-title"><li class="ItemListItem">
<xsl:element name="a">
  <xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
  <h4><xsl:value-of select="title"/></h4>
</xsl:element>

<xsl:value-of select="pubDate"/>

</li></div>

<div name="escaped" class="item-description"><xsl:value-of select="description" disable-output-escaping="yes"/></div>
<hr />
</xsl:for-each>
</ul>

<xsl:for-each select="rss/channel/textInput">
<center><strong><div class="textinput-title"><xsl:value-of select="description"/></div></strong></center>

</xsl:for-each>

</body>
</html>

</xsl:template>
</xsl:stylesheet>