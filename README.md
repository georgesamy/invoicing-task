# invoicing-task

You can find a demo hosted on heroku on https://serene-inlet-01935.herokuapp.com

To add an invoice: do a [POST] request on /api/invoices with the following JSON object

{
	"recipient": {
		"name": "Michael",
		"address": "10 degla",
		"country": "USA"
	},
	"items": [
		{
			"name": "Thinkpad",
			"quantity": 2,
			"price": 500000
		}
	]
}

To print a list of invoice totals, that is, net price, gross price and VAT: do a [GET] request on /api/invoices

To change the status of an invoice to sent: do a [PATCH] request on /api/invoices/{id}/status/sent

To change the status of an invoice to paid: do a [PATCH] request on /api/invoices/{id}/status/paid
