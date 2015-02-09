<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreditnoteAddedToInvoiceDesigns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::table('invoice_designs')->where('id', 1)->update([
			'javascript' => "var GlobalY=0;//Y position of line at current page

	    var client = invoice.client;
	    var account = invoice.account;
	    var currencyId = client.currency_id;

	    layout.headerRight = 550;
	    layout.rowHeight = 15;

	    doc.setFontSize(9);

	    if (invoice.image)
	    {
	      var left = layout.headerRight - invoice.imageWidth;
	      doc.addImage(invoice.image, 'JPEG', layout.marginLeft, 30);
	    }
	  
	    if (!invoice.is_pro && logoImages.imageLogo1)
	    {
	      pageHeight=820;
	      y=pageHeight-logoImages.imageLogoHeight1;
	      doc.addImage(logoImages.imageLogo1, 'JPEG', layout.marginLeft, y, logoImages.imageLogoWidth1, logoImages.imageLogoHeight1);
	    }

	    doc.setFontSize(9);
	    SetPdfColor('LightBlue', doc, 'primary');
	    displayAccount(doc, invoice, 220, layout.accountTop, layout);

	    SetPdfColor('LightBlue', doc, 'primary');
	    doc.setFontSize('11');

	    if (calculateAmounts(invoice).amount >= 0) {
	      doc.text(50, layout.headerTop, (invoice.is_quote ? invoiceLabels.quote : invoiceLabels.invoice).toUpperCase());
	    } else {
	      doc.text(50, layout.headerTop, invoiceLabels.creditnote.toUpperCase());
	    }

	    SetPdfColor('Black',doc); //set black color
	    doc.setFontSize(9);

	    var invoiceHeight = displayInvoice(doc, invoice, 50, 170, layout);
	    var clientHeight = displayClient(doc, invoice, 220, 170, layout);
	    var detailsHeight = Math.max(invoiceHeight, clientHeight);
	    layout.tableTop = Math.max(layout.tableTop, layout.headerTop + detailsHeight + (3 * layout.rowHeight));
	   
	    doc.setLineWidth(0.3);        
	    doc.setDrawColor(200,200,200);
	    doc.line(layout.marginLeft - layout.tablePadding, layout.headerTop + 6, layout.marginRight + layout.tablePadding, layout.headerTop + 6);
	    doc.line(layout.marginLeft - layout.tablePadding, layout.headerTop + detailsHeight + 14, layout.marginRight + layout.tablePadding, layout.headerTop + detailsHeight + 14);

	    doc.setFontSize(10);
	    doc.setFontType('bold');
	    displayInvoiceHeader(doc, invoice, layout);
	    var y = displayInvoiceItems(doc, invoice, layout);

	    doc.setFontSize(9);
	    doc.setFontType('bold');

	    GlobalY=GlobalY+25;


	    doc.setLineWidth(0.3);
	    doc.setDrawColor(241,241,241);
	    doc.setFillColor(241,241,241);
	    var x1 = layout.marginLeft - 12;
	    var y1 = GlobalY-layout.tablePadding;

	    var w2 = 510 + 24;
	    var h2 = doc.internal.getFontSize()*3+layout.tablePadding*2;

	    if (invoice.discount) {
	        h2 += doc.internal.getFontSize()*2;
	    }
	    if (invoice.tax_amount) {
	        h2 += doc.internal.getFontSize()*2;
	    }

	    //doc.rect(x1, y1, w2, h2, 'FD');

	    doc.setFontSize(9);
	    displayNotesAndTerms(doc, layout, invoice, y);
	    y += displaySubtotals(doc, layout, invoice, y, layout.unitCostRight);


	    doc.setFontSize(10);
	    Msg = invoice.is_quote ? invoiceLabels.total : invoiceLabels.balance_due;
	    var TmpMsgX = layout.unitCostRight-(doc.getStringUnitWidth(Msg) * doc.internal.getFontSize());
	    
	    doc.text(TmpMsgX, y, Msg);

	    SetPdfColor('LightBlue', doc, 'primary');
	    AmountText = formatMoney(invoice.balance_amount, currencyId);
	    headerLeft=layout.headerRight+400;
	    var AmountX = layout.lineTotalRight - (doc.getStringUnitWidth(AmountText) * doc.internal.getFontSize());
	    doc.text(AmountX, y, AmountText);"
		]);

		DB::table('invoice_designs')->where('id', 2)->update([
			'javascript' => "  var GlobalY=0;//Y position of line at current page

			  var client = invoice.client;
			  var account = invoice.account;
			  var currencyId = client.currency_id;

			  layout.headerRight = 150;
			  layout.rowHeight = 15;
			  layout.headerTop = 125;
			  layout.tableTop = 300;

			  doc.setLineWidth(0.5);

			  if (NINJA.primaryColor) {
			    setDocHexFill(doc, NINJA.primaryColor);
			    setDocHexDraw(doc, NINJA.primaryColor);
			  } else {
			    doc.setFillColor(46,43,43);
			  }  

			  var x1 =0;
			  var y1 = 0;
			  var w2 = 595;
			  var h2 = 100;
			  doc.rect(x1, y1, w2, h2, 'FD');

			  if (invoice.image)
			  {
			    var left = layout.headerRight - invoice.imageWidth;
			    doc.addImage(invoice.image, 'JPEG', layout.marginLeft, 30);
			  }

			  doc.setLineWidth(0.5);
			  if (NINJA.primaryColor) {
			    setDocHexFill(doc, NINJA.primaryColor);
			    setDocHexDraw(doc, NINJA.primaryColor);
			  } else {
			    doc.setFillColor(46,43,43);
			    doc.setDrawColor(46,43,43);
			  }  

			  // return doc.setTextColor(240,240,240);//select color Custom Report GRAY Colour
			  var x1 = 0;//tableLeft-tablePadding ;
			  var y1 = 750;
			  var w2 = 596;
			  var h2 = 94;//doc.internal.getFontSize()*length+length*1.1;//+h;//+tablePadding;

			  doc.rect(x1, y1, w2, h2, 'FD');
			  if (!invoice.is_pro && logoImages.imageLogo2)
			  {
			      pageHeight=820;
			      var left = 250;//headerRight ;
			      y=pageHeight-logoImages.imageLogoHeight2;
			      var headerRight=370;

			      var left = headerRight - logoImages.imageLogoWidth2;
			      doc.addImage(logoImages.imageLogo2, 'JPEG', left, y, logoImages.imageLogoWidth2, logoImages.imageLogoHeight2);
			  }

			  doc.setFontSize(7);
			  doc.setFontType('bold');
			  SetPdfColor('White',doc);

			  displayAccount(doc, invoice, 300, layout.accountTop, layout);


			  var y = layout.accountTop;
			  var left = layout.marginLeft;
			  var headerY = layout.headerTop;

			  SetPdfColor('GrayLogo',doc); //set black color
			  doc.setFontSize(7);

			  //show left column
			  SetPdfColor('Black',doc); //set black color
			  doc.setFontType('normal');

			  //publish filled box
			  doc.setDrawColor(200,200,200);

			  if (NINJA.secondaryColor) {
			    setDocHexFill(doc, NINJA.secondaryColor);
			  } else {
			    doc.setFillColor(54,164,152);  
			  }  

			  GlobalY=190;
			  doc.setLineWidth(0.5);

			  var BlockLenght=220;
			  var x1 =595-BlockLenght;
			  var y1 = GlobalY-12;
			  var w2 = BlockLenght;
			  var h2 = getInvoiceDetailsHeight(invoice, layout) + layout.tablePadding + 2;

			  doc.rect(x1, y1, w2, h2, 'FD');

			  SetPdfColor('SomeGreen', doc, 'secondary');
			  doc.setFontSize('14');
			  doc.setFontType('bold');
			  if (calculateAmounts(invoice).amount >= 0) {
			    doc.text(50, GlobalY, (invoice.is_quote ? invoiceLabels.your_quote : invoiceLabels.your_invoice).toUpperCase());
			  } else {
			    doc.text(50, GlobalY, invoiceLabels.your_creditnote.toUpperCase());
			  }


			  var z=GlobalY;
			  z=z+30;

			  doc.setFontSize('8');        
			  SetPdfColor('Black',doc);			  
        var clientHeight = displayClient(doc, invoice, layout.marginLeft, z, layout);
        layout.tableTop += Math.max(0, clientHeight - 75);
			  marginLeft2=395;

			  //publish left side information
			  SetPdfColor('White',doc);
			  doc.setFontSize('8');
			  var detailsHeight = displayInvoice(doc, invoice, marginLeft2, z-25, layout) + 75;
			  layout.tableTop = Math.max(layout.tableTop, layout.headerTop + detailsHeight + (2 * layout.tablePadding));

			  y=z+60;
			  x = GlobalY + 100;
			  doc.setFontType('bold');

			  doc.setFontSize(12);
			  doc.setFontType('bold');
			  SetPdfColor('Black',doc);
			  displayInvoiceHeader(doc, invoice, layout);

			  var y = displayInvoiceItems(doc, invoice, layout);
			  doc.setLineWidth(0.3);
			  displayNotesAndTerms(doc, layout, invoice, y);
			  y += displaySubtotals(doc, layout, invoice, y, layout.unitCostRight);

			  doc.setFontType('bold');

			  doc.setFontSize(12);
			  x += doc.internal.getFontSize()*4;
			  Msg = invoice.is_quote ? invoiceLabels.total : invoiceLabels.balance_due;
			  var TmpMsgX = layout.unitCostRight-(doc.getStringUnitWidth(Msg) * doc.internal.getFontSize());

			  doc.text(TmpMsgX, y, Msg);

			  //SetPdfColor('LightBlue',doc);
			  AmountText = formatMoney(invoice.balance_amount , currencyId);
			  headerLeft=layout.headerRight+400;
			  var AmountX = headerLeft - (doc.getStringUnitWidth(AmountText) * doc.internal.getFontSize());
			  SetPdfColor('SomeGreen', doc, 'secondary');
			  doc.text(AmountX, y, AmountText);"
			]);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('invoice_designs')->where('id', 1)->update([
			'javascript' => "var GlobalY=0;//Y position of line at current page

	    var client = invoice.client;
	    var account = invoice.account;
	    var currencyId = client.currency_id;

	    layout.headerRight = 550;
	    layout.rowHeight = 15;

	    doc.setFontSize(9);

	    if (invoice.image)
	    {
	      var left = layout.headerRight - invoice.imageWidth;
	      doc.addImage(invoice.image, 'JPEG', layout.marginLeft, 30);
	    }
	  
	    if (!invoice.is_pro && logoImages.imageLogo1)
	    {
	      pageHeight=820;
	      y=pageHeight-logoImages.imageLogoHeight1;
	      doc.addImage(logoImages.imageLogo1, 'JPEG', layout.marginLeft, y, logoImages.imageLogoWidth1, logoImages.imageLogoHeight1);
	    }

	    doc.setFontSize(9);
	    SetPdfColor('LightBlue', doc, 'primary');
	    displayAccount(doc, invoice, 220, layout.accountTop, layout);

	    SetPdfColor('LightBlue', doc, 'primary');
	    doc.setFontSize('11');
	    doc.text(50, layout.headerTop, (invoice.is_quote ? invoiceLabels.quote : invoiceLabels.invoice).toUpperCase());


	    SetPdfColor('Black',doc); //set black color
	    doc.setFontSize(9);

	    var invoiceHeight = displayInvoice(doc, invoice, 50, 170, layout);
	    var clientHeight = displayClient(doc, invoice, 220, 170, layout);
	    var detailsHeight = Math.max(invoiceHeight, clientHeight);
	    layout.tableTop = Math.max(layout.tableTop, layout.headerTop + detailsHeight + (3 * layout.rowHeight));
	   
	    doc.setLineWidth(0.3);        
	    doc.setDrawColor(200,200,200);
	    doc.line(layout.marginLeft - layout.tablePadding, layout.headerTop + 6, layout.marginRight + layout.tablePadding, layout.headerTop + 6);
	    doc.line(layout.marginLeft - layout.tablePadding, layout.headerTop + detailsHeight + 14, layout.marginRight + layout.tablePadding, layout.headerTop + detailsHeight + 14);

	    doc.setFontSize(10);
	    doc.setFontType('bold');
	    displayInvoiceHeader(doc, invoice, layout);
	    var y = displayInvoiceItems(doc, invoice, layout);

	    doc.setFontSize(9);
	    doc.setFontType('bold');

	    GlobalY=GlobalY+25;


	    doc.setLineWidth(0.3);
	    doc.setDrawColor(241,241,241);
	    doc.setFillColor(241,241,241);
	    var x1 = layout.marginLeft - 12;
	    var y1 = GlobalY-layout.tablePadding;

	    var w2 = 510 + 24;
	    var h2 = doc.internal.getFontSize()*3+layout.tablePadding*2;

	    if (invoice.discount) {
	        h2 += doc.internal.getFontSize()*2;
	    }
	    if (invoice.tax_amount) {
	        h2 += doc.internal.getFontSize()*2;
	    }

	    //doc.rect(x1, y1, w2, h2, 'FD');

	    doc.setFontSize(9);
	    displayNotesAndTerms(doc, layout, invoice, y);
	    y += displaySubtotals(doc, layout, invoice, y, layout.unitCostRight);


	    doc.setFontSize(10);
	    Msg = invoice.is_quote ? invoiceLabels.total : invoiceLabels.balance_due;
	    var TmpMsgX = layout.unitCostRight-(doc.getStringUnitWidth(Msg) * doc.internal.getFontSize());
	    
	    doc.text(TmpMsgX, y, Msg);

	    SetPdfColor('LightBlue', doc, 'primary');
	    AmountText = formatMoney(invoice.balance_amount, currencyId);
	    headerLeft=layout.headerRight+400;
	    var AmountX = layout.lineTotalRight - (doc.getStringUnitWidth(AmountText) * doc.internal.getFontSize());
	    doc.text(AmountX, y, AmountText);"
		]);

		DB::table('invoice_designs')->where('id', 2)->update([
			'javascript' => "  var GlobalY=0;//Y position of line at current page

			  var client = invoice.client;
			  var account = invoice.account;
			  var currencyId = client.currency_id;

			  layout.headerRight = 150;
			  layout.rowHeight = 15;
			  layout.headerTop = 125;
			  layout.tableTop = 300;

			  doc.setLineWidth(0.5);

			  if (NINJA.primaryColor) {
			    setDocHexFill(doc, NINJA.primaryColor);
			    setDocHexDraw(doc, NINJA.primaryColor);
			  } else {
			    doc.setFillColor(46,43,43);
			  }  

			  var x1 =0;
			  var y1 = 0;
			  var w2 = 595;
			  var h2 = 100;
			  doc.rect(x1, y1, w2, h2, 'FD');

			  if (invoice.image)
			  {
			    var left = layout.headerRight - invoice.imageWidth;
			    doc.addImage(invoice.image, 'JPEG', layout.marginLeft, 30);
			  }

			  doc.setLineWidth(0.5);
			  if (NINJA.primaryColor) {
			    setDocHexFill(doc, NINJA.primaryColor);
			    setDocHexDraw(doc, NINJA.primaryColor);
			  } else {
			    doc.setFillColor(46,43,43);
			    doc.setDrawColor(46,43,43);
			  }  

			  // return doc.setTextColor(240,240,240);//select color Custom Report GRAY Colour
			  var x1 = 0;//tableLeft-tablePadding ;
			  var y1 = 750;
			  var w2 = 596;
			  var h2 = 94;//doc.internal.getFontSize()*length+length*1.1;//+h;//+tablePadding;

			  doc.rect(x1, y1, w2, h2, 'FD');
			  if (!invoice.is_pro && logoImages.imageLogo2)
			  {
			      pageHeight=820;
			      var left = 250;//headerRight ;
			      y=pageHeight-logoImages.imageLogoHeight2;
			      var headerRight=370;

			      var left = headerRight - logoImages.imageLogoWidth2;
			      doc.addImage(logoImages.imageLogo2, 'JPEG', left, y, logoImages.imageLogoWidth2, logoImages.imageLogoHeight2);
			  }

			  doc.setFontSize(7);
			  doc.setFontType('bold');
			  SetPdfColor('White',doc);

			  displayAccount(doc, invoice, 300, layout.accountTop, layout);


			  var y = layout.accountTop;
			  var left = layout.marginLeft;
			  var headerY = layout.headerTop;

			  SetPdfColor('GrayLogo',doc); //set black color
			  doc.setFontSize(7);

			  //show left column
			  SetPdfColor('Black',doc); //set black color
			  doc.setFontType('normal');

			  //publish filled box
			  doc.setDrawColor(200,200,200);

			  if (NINJA.secondaryColor) {
			    setDocHexFill(doc, NINJA.secondaryColor);
			  } else {
			    doc.setFillColor(54,164,152);  
			  }  

			  GlobalY=190;
			  doc.setLineWidth(0.5);

			  var BlockLenght=220;
			  var x1 =595-BlockLenght;
			  var y1 = GlobalY-12;
			  var w2 = BlockLenght;
			  var h2 = getInvoiceDetailsHeight(invoice, layout) + layout.tablePadding + 2;

			  doc.rect(x1, y1, w2, h2, 'FD');

			  SetPdfColor('SomeGreen', doc, 'secondary');
			  doc.setFontSize('14');
			  doc.setFontType('bold');
			  doc.text(50, GlobalY, (invoice.is_quote ? invoiceLabels.your_quote : invoiceLabels.your_invoice).toUpperCase());


			  var z=GlobalY;
			  z=z+30;

			  doc.setFontSize('8');        
			  SetPdfColor('Black',doc);			  
        var clientHeight = displayClient(doc, invoice, layout.marginLeft, z, layout);
        layout.tableTop += Math.max(0, clientHeight - 75);
			  marginLeft2=395;

			  //publish left side information
			  SetPdfColor('White',doc);
			  doc.setFontSize('8');
			  var detailsHeight = displayInvoice(doc, invoice, marginLeft2, z-25, layout) + 75;
			  layout.tableTop = Math.max(layout.tableTop, layout.headerTop + detailsHeight + (2 * layout.tablePadding));

			  y=z+60;
			  x = GlobalY + 100;
			  doc.setFontType('bold');

			  doc.setFontSize(12);
			  doc.setFontType('bold');
			  SetPdfColor('Black',doc);
			  displayInvoiceHeader(doc, invoice, layout);

			  var y = displayInvoiceItems(doc, invoice, layout);
			  doc.setLineWidth(0.3);
			  displayNotesAndTerms(doc, layout, invoice, y);
			  y += displaySubtotals(doc, layout, invoice, y, layout.unitCostRight);

			  doc.setFontType('bold');

			  doc.setFontSize(12);
			  x += doc.internal.getFontSize()*4;
			  Msg = invoice.is_quote ? invoiceLabels.total : invoiceLabels.balance_due;
			  var TmpMsgX = layout.unitCostRight-(doc.getStringUnitWidth(Msg) * doc.internal.getFontSize());

			  doc.text(TmpMsgX, y, Msg);

			  //SetPdfColor('LightBlue',doc);
			  AmountText = formatMoney(invoice.balance_amount , currencyId);
			  headerLeft=layout.headerRight+400;
			  var AmountX = headerLeft - (doc.getStringUnitWidth(AmountText) * doc.internal.getFontSize());
			  SetPdfColor('SomeGreen', doc, 'secondary');
			  doc.text(AmountX, y, AmountText);"
			]);


	}

}
