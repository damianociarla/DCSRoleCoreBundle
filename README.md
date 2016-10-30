[![Build Status](https://travis-ci.org/damianociarla/DCSRoleCoreBundle.svg?branch=master)](https://travis-ci.org/damianociarla/DCSRoleCoreBundle) [![Coverage Status](https://coveralls.io/repos/github/damianociarla/DCSRoleCoreBundle/badge.svg?branch=master)](https://coveralls.io/github/damianociarla/DCSRoleCoreBundle?branch=master)

# DCSRoleCoreBundle

This bundle provides the basic services for the role management. Also it provides an option to set a default user role during the authentication process.

The base configuration requires that you specify the provider for the recovery of roles. They were made available two providers to install:

[DCSRoleProviderORMBundle](https://github.com/damianociarla/DCSRoleProviderORMBundle) 
Provider for the management of user roles using Doctrine ORM.

[DCSRoleProviderArrayBundle](https://github.com/damianociarla/DCSRoleProviderArrayBundle) 
Provider for the management of user roles using an array.

## Installation

### Prerequisites

This bundle requires [DCSSecurityCoreBundle](https://github.com/damianociarla/DCSSecurityCoreBundle).

### Require the bundle

Run the following command:

	$ composer require dcs/role-core-bundle "~1.0@dev"

Composer will install the bundle to your project's `vendor/dcs/role-core-bundle` directory.

### Enable the bundle

Enable the bundle in the kernel:

	<?php
	// app/AppKernel.php

	public function registerBundles()
	{
		$bundles = array(
			// ...
			new DCS\Role\CoreBundle\DCSRoleCoreBundle(),
			// ...
		);
	}

### Configure

Now that you have properly enabled this bundle, the next step is to configure it to work with the specific needs of your application.

Add the following configuration to your `config.yml`.

    dcs_role_core:
        provider: YOUR_PROVIDER_SERVICE

# Reporting an issue or a feature request

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/damianociarla/DCSRoleCoreBundle/issues).
