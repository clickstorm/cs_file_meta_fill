.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt

.. _introduction:

Introduction
============

.. _what-it-does:

What does it do?
----------------

Clickstorm File Meta Fill automatically fills File Metadata when uploading or editing files without existing metadata.

.. _features:

Features
--------

- Zero Configuration necessary
- Fill File Alternative and Title Fields
- Stores original file names for best results (to keep Umlauts and Characters sanitized)
- There is a **Scheduler Task** included (Extbase Command Controller) to batch process files missing metadata information

Examples
--------

- Upload a new File **Steinweg 7, München.jpg**
- File Meta Fill automatically sets the File Alternative Text and Title to **Steinweg 7, München**
- Upload new File **Steinweg_7_München.jpg**
- File Meta Fill automatically sets the File Alternative Text and Title to **Steinweg 7 München**