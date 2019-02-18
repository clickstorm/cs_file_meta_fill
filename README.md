# [clickstorm] File Meta Fill

Automatically fills sys_file_metadata from file names. For TYPO3 v8 and v9.

e.g. filename: product_red_socks.jpg => alt: Product Red Socks

## How does it work?

- There is a Hook included which is called every time a file is updated (via Backend) and is missing title or alternative metadata.
- There is a Scheduler Task to batch process file_metadata entries
- It stores the original file names on file uploads and prioritizes these if existent

## Usage

- `composer req clickstorm/cs-file-meta-fill`
- Activate the extension
- Upload or edit any file
- Close and reopen and see the magic!

## More Information

- [Changelog](CHANGELOG) - Latest Changes
- [TYPO3 Repository](https://extensions.typo3.org/extension/cs_file_meta_fill/) - Official download page
- [Extension Manual](https://docs.typo3.org/typo3cms/extensions/cs_file_meta_fill/) - Official documentation with all features and configurations 
- [clickstorm Blog](https://www.clickstorm.de/blog/) - Current information in german