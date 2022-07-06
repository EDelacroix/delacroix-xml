<?xml version='1.0' encoding='UTF-8'?>
<xsl:transform version="1.0" 
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
  xmlns="http://www.w3.org/1999/xhtml" 
  xmlns:tei="http://www.tei-c.org/ns/1.0" exclude-result-prefixes="tei">
  <xsl:import href="elicom_html.xsl"/>
  <xsl:output encoding="UTF-8" indent="yes" media-type="text/html" method="xml"/>
  <xsl:param name="theme">theme/</xsl:param>
  <xsl:template match="/*">
    <html>
      <head>
        <meta charset="UTF-8" />
        <title>
          <xsl:value-of select="/tei:TEI/tei:teiHeader/tei:fileDesc/tei:titleStmt/tei:title"/>
        </title>
        <link rel="stylesheet" href="https://delacroix.huma-num.fr/theme/delacroix.css" />
      </head>
      <body class="lettres">
        <div id="content">
          <div class="content">
            <header>
              <h1>
                <xsl:apply-templates select="/tei:TEI/tei:teiHeader/tei:fileDesc/tei:titleStmt/tei:title/node()"/>
              </h1>
              <xsl:apply-templates select="tei:teiHeader"/>
            </header>
            <div class="letter">
              <xsl:apply-templates select="tei:text"/>
            </div>
            <footer class="footnotes">
              <xsl:apply-templates select="tei:text" mode="footnote"/>
            </footer>
          </div>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:transform>
