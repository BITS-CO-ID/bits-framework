## Introduction

BITS Framework is an open-source project and anyone may contribute to BITS Framework for its improvement. We welcome contributors, regardless of skill level, gender, race, religion, or nationality. Having a diverse, vibrant community is one of the core values of the framework!
To encourage active collaboration, BITS Framework currently only accepts pull requests, not bug reports. "Bug reports" may be sent in the form of a pull request containing a failing unit test. Alternatively, a demonstration of the bug within a sandbox BITS Framework application may be sent as a pull request to the main BITS Framework repository. A failing unit test or sandbox application provides the development team "proof" that the bug exists, and, after the development team addresses the bug, serves as a reliable indicator that the bug remains fixed.

The BITS Framework source code is managed on Github, and there are repositories for each of the BITS Framework projects:

    BITS Framework
    BITS Framework Application
    BITS Framework Documentation
    BITS Framework Website

## New Features

Before sending pull requests for new features, please contact Nurul Imam via the #BITS-dev IRC channel (Freenode). If the feature is found to be a good fit for the framework, you are free to make a pull request. If the feature is rejected, don't give up! You are still free to turn your feature into a package which can be released to the world via Packagist.

When adding new features, don't forget to add unit tests! Unit tests help ensure the stability and reliability of the framework as new features are added.

## Bugs

Pull requests for bugs may be sent without prior discussion with the BITS Framework development team. When submitting a bug fix, try to include a unit test that ensures the bug never appears again!

If you believe you have found a bug in the framework, but are unsure how to fix it, please send a pull request containing a failing unit test. A failing unit test provides the development team "proof" that the bug exists, and, after the development team addresses the bug, serves as a reliable indicator that the bug remains fixed.

If are unsure how to write a failing unit test for a bug, review the other unit tests included with the framework. If you're still lost, you may ask for help in the #BITS Framework IRC channel (Freenode).

All bug fixes should be sent to the latest stable branch. Bug fixes should never be sent to the master branch unless they fix features that exist only in the upcoming release.

Minor features that are fully backwards compatible with the current BITS Framework release may be sent to the latest stable branch.

Major new features should always be sent to the master branch, which contains the upcoming BITS Framework release.

If you are unsure if your feature qualifies as a major or minor, please ask Nurul Imam in the #BITS Framework-dev IRC channel (Freenode).

## Security Vulnerabilities

If you discover a security vulnerability within BITS Framework, please send an e-mail to Nurul Imam at nurulimamstudio@gmail.com. All security vulnerabilities will be promptly addressed.

## Coding Style

BITS Framework follows the PSR-0 and PSR-1 coding standards. In addition to these standards, the following coding standards should be followed:

    The class namespace declaration must be on the same line as <?php.
    A class' opening { must be on the same line as the class name.
    Functions and control structures must use Allman style braces.
    Indent with tabs, align with spaces.