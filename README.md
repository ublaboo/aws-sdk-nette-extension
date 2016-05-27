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

Configure extension in your config.neon file:

``` yaml
aws:
	region: eu-west-1
	version: latest
	credentials:
		key: your_access_key
		secret: your_secret_access_key
```
			
## Usage

Now you can use the S3Client instance either in Presenter:

```php
class HomepagePresenter extends Presenter
{

	/**
	 * @var \Aws\S3\S3Client
	 * @inject
	 */
	public $s3;


	public function actionDefault()
	{
		$this->s3->putObject([
			'Bucket' => 'YourBucker',
			'Key' => 'YourObjectKey',
			'Body' => fopen('/path/to/file', 'r')
		]);
	}

}
```

Or in some other service:

```php
class s3Service
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

