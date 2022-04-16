<?xml version="1.0" encoding="utf-8"?> 
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" >
<xsl:output method="xml" version="1.0" omit-xml-declaration="yes" indent="yes" media-type="text/html"/>
    


<xsl:template match="item">
	<xsl:element name="div">
		<xsl:attribute name="class">
			<xsl:text>col-lg-12</xsl:text>
		</xsl:attribute>

		<xsl:element name="div">
			<xsl:attribute name="class">
				<xsl:text>card</xsl:text>
			</xsl:attribute>

			<img>
				<xsl:attribute name="src">
					<xsl:text>../image/</xsl:text>
					<xsl:value-of select="imageFile" />
				</xsl:attribute>
				<xsl:attribute name="class">
					<xsl:text>card-img-top</xsl:text>
				</xsl:attribute>
			</img>

			<xsl:element name="div">
				<xsl:attribute name="class">
					<xsl:text>card-body</xsl:text>
				</xsl:attribute>

				<xsl:element name="center">

					<xsl:element name="h4">
						<xsl:attribute name="class">
							<xsl:text>card-title</xsl:text>
						</xsl:attribute>

						<xsl:value-of select="title" />

					</xsl:element>


					<xsl:element name="p">
						<xsl:attribute name="class">
							<xsl:text>card-text</xsl:text>
						</xsl:attribute>

						<xsl:value-of select="description" />

					</xsl:element>

				</xsl:element>

			</xsl:element>



		</xsl:element>

	</xsl:element>


		
</xsl:template>

</xsl:stylesheet>