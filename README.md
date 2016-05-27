# aws-sdk-nette-extension
A Nette extension for the AWS SDK for PHP http://aws.amazon.com/sdkforphp/

##Installation

Download extension using composer

```
composer require ublaboo/aws-sdk-nette-extension
```

Register extension in your config.neon file:

``` yaml
extensions:
	aws: Ublaboo\AwsSdkNetteExtension\DI\AwsSdkNetteExtension
```

## Configuration

Configure extension in your `config.neon` file:

``` yaml
aws:
	region: eu-west-1
	version: latest
```

And put your key and secret in your `config.local.neon` file (which should not be versioned)

``` yaml
aws:
	credentials:
		key: your_access_key
		secret: your_secret_access_key
```
			
## Usage

Ideally create some services wrapping the S3 client with your logic inside them

```php
class S3Service
{

	/**
	 * @var \Aws\S3\S3Client
	 */
	public $s3;


	public function __construct(\Aws\S3\S3Client $s3)
	{
		$this->s3 = $s3;
	}


	public function save($path_to_file)
	{
		$this->s3->putObject([
			'Bucket'     => 'YourBucket',
			'Key'        => 'YourObjectKey',
			'SourceFile' => $path_to_file,
		]);
	}

}
```

And use them in your presenters:

```php
class HomepagePresenter extends Presenter
{

	/**
	 * @var S3Service
	 * @inject
	 */
	public $service;


	public function actionDefault()
	{
		$this->service->save('/path/to/file');
	}

}
```

