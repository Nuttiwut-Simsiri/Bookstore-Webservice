<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
  <body>
  <h2>This is Bookstore XML</h2>
    <table border="4">
      <tr bgcolor="#00FFFF">
        <th style="text-align:left">Title</th>
        <th style="text-align:left">Author</th>
        <th style="text-align:left">Publisher</th>
        <th style="text-align:left">Publish Day</th>
        <th style="text-align:left">Type</th>
        <th style="text-align:left">Language</th>
        <th style="text-align:left">Price</th>
        <th style="text-align:left">Height</th>
        <th style="text-align:left">Th_Price</th>
      </tr>

      <xsl:for-each select="bookstore/book">
      <tr bgcolor="#FEFEFE">
        <td><xsl:value-of select="title"/></td>
        <td><xsl:value-of select="author"/></td>
        <td><xsl:value-of select="publisher"/></td>
        <td><xsl:value-of select="publish_date"/></td>
        <td><xsl:value-of select="type"/></td>
        <td><xsl:value-of select="language"/></td>
        <td><xsl:value-of select="price"/></td>
        <td><xsl:value-of select="height"/></td>
        <td><xsl:value-of select="th_price"/></td>
      </tr>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>

