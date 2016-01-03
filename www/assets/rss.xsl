<?xml version="1.0" encoding="utf-8"?> 
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"> 
<xsl:template match="/"> 
<html> 
    <head> 
        <title><xsl:value-of select="rss/channel/title"/></title>
    </head> 
    <body style="background: url('http://jamesdoc.com/assets/graphics/bg.gif') #2b2b2b; margin: 20px 10%;color: #fff; font-family:Metrophobic,Arial,Helvetica,Verdana,sans-serif;font-size:1em;"> 
        
        <div style="line-height: 1.45em;"> 
        <h1 style="color: #8B0000; font-size: 3.4em;line-height: 1.5em;border-bottom: 3px solid #3b3b3b;text-shadow: 1px 1px 1px #000;"><xsl:value-of select="rss/channel/title"/> - RSS Feed</h1>
        <p>Welcome to the RSS feed!  This is actually designed to be read by a machine, which don't appear to be... If you want to use this with your prefered RSS reader just copy and paste the URL of this page and paste it into your feed software.  If you think you are here by accident you should go back to the home page.</p> 
        <p>This RSS contains the last 20 items that have been posted to my blog, it is designed to be imported into various programs such as <a href="http://reader.google.com" target="_blank" style="color: #fff; text-decoration: none; border-bottom: 1px solid #8B0000; text-shadow: 1px 1px 1px #8B0000;">Google Reader</a> (web), <a href="http://netnewswireapp.com/" target="_blank" style="color: #fff; text-decoration: none; border-bottom: 1px solid #8B0000; text-shadow: 1px 1px 1px #8B0000;">New News Wire</a> (OS X) or <a href="http://www.newzcrawler.com/" target="_blank" style="color: #fff; text-decoration: none; border-bottom: 1px solid #8B0000; text-shadow: 1px 1px 1px #8B0000;">Newz Crawler</a> (Windows)</p>
        <p>If you want to know more than you possibly need to know about RSS please read the <a href="http://en.wikipedia.org/wiki/RSS_Feed" target="_blank" style="color: #fff; text-decoration: none; border-bottom: 1px solid #8B0000; text-shadow: 1px 1px 1px #8B0000;">Wikipedia Article on RSS</a></p>  
        </div> 
 
        <p style="border-top: 3px solid #3b3b3b;padding-top: 1em;margin-top: 1.5em;font-size: 1.75em">Items in this feed:</p> 
        <ul> 
        <xsl:for-each select="rss/channel/item"> 
            <li> 
                <p><xsl:value-of select="title"/> <i style="float:right"><xsl:value-of select="pubDate"/></i></p>
            </li> 
        </xsl:for-each> 
        </ul>
	</body> 
</html> 
</xsl:template> 
</xsl:stylesheet> 